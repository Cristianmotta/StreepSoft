<?php
declare(strict_types=1);

session_start();

require_once __DIR__. '/../../config/database.php';
require_once __DIR__. '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__.  '/../models/Recuperacion.php';


class RecuperacionController 
{
    private RecuperacionModel $model;

    public function __construct()
    {
        global $pdo;
        $this->model = new RecuperacionModel($pdo);
    }

    public function enviarPin(string $usuario): void
    {

        $username = $this->model->buscarUsuario($usuario);

        if(!$username){
            die('Usuario no encontrado');
        }

        $pin = (string) random_int(10000, 99999);
        $pinHash = password_hash($pin, PASSWORD_BCRYPT);
        $token = bin2hex(random_bytes(32));

        $expiracion = date(
            'Y-m-d H:i:s',
            strtotime('+10 minutes')
        );

        $guardado = $this->model->guardarPin(
            $usuario,
            $pinHash,
            $token,
            $expiracion
        );

        if(!$guardado) {
            die('Error guardando PIN');
        }

        $mail = new PHPMailer(true);
        

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'streepsoftcolombia@gmail.com';
            $mail->Password = 'fthowdgizpgjmobl';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom(
                'streepsoftcolombia@gmail.com',
                'streepsoft'
            );
            $mail->addAddress($usuario);
            $mail->isHTML(true);
            $mail->Subject = 'Recuperacion de contraseña';

            $ruta_imgen = $_SERVER['DOCUMENT_ROOT'] . '/streepsoft/public/Image/CopColombiaInternacional.png';
            
            $mail->addEmbeddedImage($ruta_imgen, 'logo_streepsoft');
            
            
            $mail->Body = "
                <div style='
                background-color: #1a1a1a; 
                padding: 30px 10px; 
                font-family: sans-serif; 
                text-align: center;
            '>
                <div style='
                    max-width: 420px; 
                    margin: 0 auto; 
                    background-color: #232323; 
                    border: 2px solid #f5c400; 
                    border-radius: 14px; 
                    padding: 40px 30px; 
                    text-align: center;
                    box-sizing: border-box;
                '>
                    
                    <div style='margin-bottom: 25px;'>
                        <img src='cid:logo_streepsoft' 
                            alt='Seguridad' 
                            style='width: 200px; height: auto; display: inline-block;' 
                            draggable='false'>
                    </div>

                    <h2 style='
                        color: #ffffff; 
                        font-size: 27px; 
                        margin-top: 0; 
                        margin-bottom: 15px; 
                        font-weight: bold;
                    '>
                        Recuperación de contraseña
                    </h2>

                    <p style='
                        color: #cccccc; 
                        font-size: 14px; 
                        line-height: 1.5; 
                        margin-bottom: 25px;
                    '>
                        Tu PIN de seguridad es:
                    </p>

                    <div style='
                        background-color: #e0e0e0; 
                        border-radius: 8px; 
                        padding: 15px; 
                        margin-bottom: 25px;
                    '>
                        <h1 style='
                            text-align: center; 
                            color: #000000; 
                            letter-spacing: 8px; 
                            font-size: 32px; 
                            font-family: monospace; 
                            margin: 0; 
                            font-weight: bold;
                        '>
                            $pin
                        </h1>
                    </div>

                    <p style='
                        color: #f5c400; 
                        font-size: 13px; 
                        margin-top: 15px; 
                        margin-bottom: 0;
                    '>
                        ⏱ Este PIN expirará en 1 minuto.
                    </p>

                </div>
            </div>
            ";

            $mail->send();

            header("Location: /streepsoft/app/views/auth/verificarCodigo.php?usuario=" . urldecode($usuario));

        } catch (Exception $e){
            echo 'Error enviando correo';
        }
    }

    public function nuevaPassword(string $usuario, string $password): bool
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);

        return $this->model->actualizarPassword($usuario, $hash);
    }

    public function verificarpin(string $usuario, string $pinIngresado): void
    {
        $datos = $this->model->obtenerPin($usuario);

        if (!$datos) {
            die("PIN no encontrado");
        }

        if (strtotime($datos['expired_session']) < time()) {
            die("PIN expirado");
        }

        if (!password_verify($pinIngresado, $datos['pin_recuperacion'])) {
            die("PIN incorrecto");
        }

        $_SESSION['usuario_recuperacion'] = $usuario;

        header("Location: /streepsoft/app/views/auth/actualizarContraseña.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $controller = new RecuperacionController();

     if (isset($_POST['enviar_correo'])) {

        $usuario = trim($_POST['usuario']);

        $controller->enviarPin($usuario);
    }

    if (isset($_POST['verificar_pin'])) {

        $usuario = trim($_POST['usuario']);

        $pin = implode($_POST['pin']); // hidden input

        $controller->verificarPin($usuario, $pin);
    }

    if (isset($_POST['cambiar_password'])) {

        $usuario = $_SESSION['usuario_recuperacion'] ?? null;

        if (!$usuario) {
            die('Sesión de recuperación expirada o inválida');
        }

        $password = trim($_POST['password']);
        $confirmar = trim($_POST['confirmar_password']);


        if ($password !== $confirmar) {
            die('Las contraseñas no coinciden');
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);


        $actualizado = $controller->nuevaPassword($usuario, $password);

        if (!$actualizado) {
            die('Error actualizando contraseña');
        }

        unset($_SESSION['usuario_recuperacion']);

        header(
            'Location: /streepsoft/app/views/auth/login.php?password=success'
        );

        exit;
    }
}

?>