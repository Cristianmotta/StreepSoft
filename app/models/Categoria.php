<?php

class Categoria extends Model
{
    protected static $table = 'categorias';
    protected static $primaryKey = 'id';

    
     //Obtener categorías activas 
     
    public function obtenerActivas(): array
    {
        $sql = "SELECT id, nombre FROM categorias WHERE activa = 1 ORDER BY nombre ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
     //Obtener todas las categorías
     
    public function obtenerTodas(): array
    {
        $sql = "SELECT * FROM categorias ORDER BY nombre ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    //Obtener categoría por ID
     
    public function obtenerPorId(int $id): ?array
    {
        $sql = "SELECT * FROM categorias WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}