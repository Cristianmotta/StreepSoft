<?php
declare(strict_types=1);

require_once __DIR__. '/../../config/database.php';

class usuario
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function obtenerporusuario(string $usuario): array|null
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':usuario' => $usuario
        ]);
        
        return $stmt->fetch() ?: null;
    }

    

    
}


?>