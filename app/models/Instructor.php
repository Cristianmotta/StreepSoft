<?php

class Instructor extends Model
{
    protected static $table = 'instructores';
    protected static $primaryKey = 'id';

    
     //Obtener instructores activos
     
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

    
    //Obtener todos los instructores (incluye inactivos)
     
    public function obtenerTodos(): array
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

    
     //Cambiar estado del instructor (activar/desactivar)
     
    public function cambiarEstado(int $id, int $activo): bool
    {
        $sql = "UPDATE instructores SET activo = :activo WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':activo' => $activo
        ]);
    }

    
    //Retirar instructor (poner inactivo)
     
    public function retirar(int $id): bool
    {
        return $this->cambiarEstado($id, 0);
    }

    
    //Activar instructor
     
    public function activar(int $id): bool
    {
        return $this->cambiarEstado($id, 1);
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