<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../../config/database.php';

$usuarioModel = new Usuario($pdo);

$usuarioInput = trim($_POST['usuario'] ?? '');
$contrasenaInput = trim($_POST['contrasena'] ?? '');

$usuario = $usuarioModel->obtenerporusuario($usuarioInput);

if (!$usuario) {
    header('Location: /streepsoft/app/views/auth/login.php?error=1');
    exit;
}

if (!password_verify($contrasenaInput, $usuario['contrasena'])) {
    header('Location: /streepsoft/app/views/auth/login.php?error=1');
    exit;
}

$_SESSION['usuario'] = [
    'id' => $usuario['id'],
    'usuario' => $usuario['usuario']
];

header("Location: /streepsoft/app/views/dashboard/index.php");
exit;

?>