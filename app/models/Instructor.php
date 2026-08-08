<?php

class Instructor extends Model
{
    protected static $table = 'instructores';
    protected static $primaryKey = 'id';

    
    //Obtener todos los instructores activos
     
    public function obtenerActivos(): array
    {
        $sql = "SELECT i.*, c.nombre AS categoria_nombre
                FROM instructores i
                LEFT JOIN categorias c ON i.categoria_id = c.id
                WHERE i.activo = 1
                ORDER BY i.nombre ASC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    //Obtener todos los instructores
     
    public function obtenerTodas(): array
    {
        $sql = "SELECT i.*, c.nombre AS categoria_nombre
                FROM instructores i
                LEFT JOIN categorias c ON i.categoria_id = c.id
                ORDER BY i.nombre ASC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    //Obtener instructor por ID
     
    public function obtenerPorId(int $id): ?array
    {
        $sql = "SELECT i.*, c.nombre AS categoria_nombre
                FROM instructores i
                LEFT JOIN categorias c ON i.categoria_id = c.id
                WHERE i.id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    
     //Obtener instructores por categoría
     
    public function obtenerPorCategoria(int $categoriaId): array
    {
        $sql = "SELECT * FROM instructores 
                WHERE categoria_id = :categoria_id AND activo = 1
                ORDER BY nombre ASC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':categoria_id' => $categoriaId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener instructores como opciones para selects
     */
    public function getOpciones(): array
    {
        $sql = "SELECT id, nombre FROM instructores WHERE activo = 1 ORDER BY nombre ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}