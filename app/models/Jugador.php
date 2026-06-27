<?php
declare(strict_types=1);

require_once __DIR__. '/../../config/database.php';

class Jugador {

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function obtenerTodos() {
        $sql = "
            SELECT * 
            FROM vista_jugadores
            ORDER BY apellidos, nombres
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM jugadores WHERE id_jugadores = :id");
        return $stmt->execute([':id' => $id]);
    }
    
}


?>