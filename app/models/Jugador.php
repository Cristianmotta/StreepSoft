<?php
declare(strict_types=1);

/**
 * Jugador - Modelo de jugadores
 * 
 * ¿Qué hace?
 * - Obtiene jugadores de la base de datos
 * - Crea, actualiza, elimina jugadores
 * - Comunica con vista_jugadores
 */
class Jugador extends Model
{
    /**
     * Obtener todos los jugadores
     * 
     * ¿Qué hace?
     * - Consulta la base de datos
     * - Retorna un array con todos los jugadores
     * 
     * @return array - Lista de jugadores
     */
    public function obtenerTodos(): array
    {
        $sql = "
            SELECT * 
            FROM vista_jugadores
            ORDER BY apellidos, nombres
        ";
        
        return $this->query($sql);
    }

    /**
     * Obtener un jugador por ID
     * 
     * @param int $id - ID del jugador
     * @return array|null - Datos del jugador o null si no existe
     */
    public function obtenerPorId(int $id): ?array
    {
        $sql = "
            SELECT * 
            FROM vista_jugadores
            WHERE id_jugadores = ?
            LIMIT 1
        ";
        
        return $this->queryOne($sql, [$id]);
    }

    /**
     * Obtener jugadores por categoría
     * 
     * @param int $categoriaId - ID de la categoría
     * @return array - Jugadores de esa categoría
     */
    public function obtenerPorCategoria(int $categoriaId): array
    {
        $sql = "
            SELECT * 
            FROM vista_jugadores
            WHERE id_categoria = ?
            ORDER BY apellidos, nombres
        ";
        
        return $this->query($sql, [$categoriaId]);
    }

    /**
     * Obtener jugadores con deuda
     * 
     * @return array - Jugadores que tienen deuda
     */
    public function obtenerConDeuda(): array
    {
        $sql = "
            SELECT * 
            FROM vista_jugadores
            WHERE tiene_deuda = 1
            ORDER BY apellidos, nombres
        ";
        
        return $this->query($sql);
    }

    /**
     * Crear un nuevo jugador
     * 
     * @param array $datos - Datos del jugador
     * @return bool - True si fue exitoso
     */
    public function crear(array $datos): bool
    {
        $sql = "
            INSERT INTO jugadores (
                nombres,
                apellidos,
                email,
                telefono,
                id_categoria
            ) VALUES (?, ?, ?, ?, ?)
        ";
        
        return $this->execute($sql, [
            $datos['nombres'] ?? null,
            $datos['apellidos'] ?? null,
            $datos['email'] ?? null,
            $datos['telefono'] ?? null,
            $datos['id_categoria'] ?? null,
        ]);
    }

    /**
     * Actualizar un jugador
     * 
     * @param int $id - ID del jugador
     * @param array $datos - Nuevos datos
     * @return bool - True si fue exitoso
     */
    public function actualizar(int $id, array $datos): bool
    {
        $sql = "
            UPDATE jugadores
            SET nombres = ?,
                apellidos = ?,
                email = ?,
                telefono = ?,
                id_categoria = ?
            WHERE id_jugadores = ?
        ";
        
        return $this->execute($sql, [
            $datos['nombres'] ?? null,
            $datos['apellidos'] ?? null,
            $datos['email'] ?? null,
            $datos['telefono'] ?? null,
            $datos['id_categoria'] ?? null,
            $id
        ]);
    }

    /**
     * Eliminar un jugador
     * 
     * @param int $id - ID del jugador a eliminar
     * @return bool - True si fue exitoso
     */
    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM jugadores WHERE id_jugadores = ?";
        return $this->execute($sql, [$id]);
    }

    /**
     * Contar jugadores
     * 
     * @return int - Total de jugadores
     */
    public function contar(): int
    {
        $sql = "SELECT COUNT(*) as total FROM vista_jugadores";
        $result = $this->queryOne($sql);
        return $result['total'] ?? 0;
    }
}