<?php
declare(strict_types=1);

require_once __DIR__. '/../../config/database.php';

class RecuperacionModel {

    private PDO $db;
 
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Buscar usuarios por usuario 
    public function buscarUsuario(string $usuario): array|false
    {
        $sql = "SELECT * FROM usuarios 
                WHERE usuario = :usuario";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Guardar PIN y token
    public function guardarPin(string $usuario,string $pinHash,string $token,string $expiracion): bool
    {
        $sql = "UPDATE usuarios
                SET pin_recuperacion = :pin,
                    token_password = :token,
                    expired_session = :expiracion,
                    request_password = 0
                WHERE usuario = :usuario";
        
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':pin', $pinHash);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expiracion', $expiracion);
        $stmt->bindParam(':usuario', $usuario);

        return $stmt->execute();
    }

    // Verificar PIN
    public function obtenerPin(string $usuario): array|false
    {
        $sql = "SELECT pin_recuperacion, 
                       expired_session
                FROM usuarios
                WHERE usuario = :usuario";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }    

    // Actualizar Contraseña
    public function actualizarPassword(string $usuario,string $passwordHash): bool
    {
        $sql = "UPDATE usuarios
                SET contrasena = :contrasena,
                    request_password = 1,
                    pin_recuperacion = NULL,
                    token_password = NULL,
                    expired_session = NULL
                WHERE usuario = :usuario";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':contrasena', $passwordHash);
        $stmt->bindParam(':usuario', $usuario);

        return $stmt->execute();
    }
}

?>