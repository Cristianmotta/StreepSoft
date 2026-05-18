<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../../config/database.php';

$usuarioModel = new Usuario($pdo);

$usuarioInput = $_POST['usuario'] ?? '';
$contrasenaInput = $_POST['contrasena'] ?? '';

$usuario = $usuarioModel->obtenerporusuario($usuarioInput);

if ($usuario && !empty($usuario['contrasena'])){

    if(password_verify($contrasenaInput, $usuario['contrasena'])){

        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'usuario' => $usuario['usuario'] 
        ];

          header("Location: /streepsoft/app/views/dashboard/index.php");
    }else {

        header("Location: /streepsoft/app/views/auth/login.php?error=1");
    }
}else{
    echo "El usuario no existe";
}

?>
