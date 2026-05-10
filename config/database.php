<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'streepsoftbd');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}


//Login conexion
//<?php
//session_start();
require 'conexion.php'; // Incluir archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Consulta preparada para evitar SQL Injection
    $stmt = $conn->prepare("SELECT id, password FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verificar la contraseña cifrada
        if (password_verify($password, $row['password'])) {
            $_SESSION['usuario'] = $usuario;
            header("location: dashboard.php"); // Redirigir
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
    $stmt->close();
}
//



