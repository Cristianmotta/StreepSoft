<?php
declare(strict_types=1);

require_once __DIR__. '/../../config/database.php';

class RecuperacionModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function buscarUsuario(string $usuario): array|false
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['usuario' => $usuario]);

        return $stmt->fetch() ?: false;
    }

    public function guardarPin(string $usuario, string $pinHash, string $token, string $expiracion): bool
    {
        $sql = "UPDATE usuarios 
                SET pin_recuperacion = :pin,
                    token_password = :token,
                    expired_session = :expiracion,
                    request_password = 0
                WHERE usuario = :usuario";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'pin' => $pinHash,
            'token' => $token,
            'expiracion' => $expiracion,
            'usuario' => $usuario
        ]);
    }

    public function obtenerPin(string $usuario): array|false
    {
        $sql = "SELECT pin_recuperacion, expired_session 
                FROM usuarios 
                WHERE usuario = :usuario";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['usuario' => $usuario]);

        return $stmt->fetch() ?: false;
    }

    public function actualizarPassword(string $usuario, string $passwordHash): bool
    {
        $sql = "UPDATE usuarios 
                SET contrasena = :contrasena,
                    request_password = 1,
                    pin_recuperacion = NULL,
                    token_password = NULL,
                    expired_session = NULL
                WHERE usuario = :usuario";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'contrasena' => $passwordHash,
            'usuario' => $usuario
        ]);
    }
}

?>