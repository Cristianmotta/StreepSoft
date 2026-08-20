<?php

declare(strict_types=1);

/**Deuda
 * Modelo para la tabla Deudas, que guarda tanto la matrícula/mensualidad
 * de cada jugador como el estado de pago (pagado, pendiente, mora).
 */
class Deuda extends Model
{
    /** Trae todos los registros de deudas/pagos, con el nombre del jugador
     * y su categoría ya incluidos */
    public function obtenerTodas(): array
    {
        $sql = "SELECT d.*,
                       j.nombres, j.apellidos,
                       c.nombre AS categoria_nombre
                FROM deudas d
                INNER JOIN jugadores j ON d.id_jugadores = j.id_jugadores
                LEFT JOIN categorias c ON j.id_categorias = c.id_categorias
                ORDER BY d.fecha_limite_pago DESC";

        return $this->query($sql);
    }

    /** Trae solo los registros con deuda real (pendiente o en mora),
     * excluyendo los que ya están pagados. Usado por el Reporte de Deudas.*/
    public function obtenerPendientes(): array
    {
        $sql = "SELECT d.*,
                       j.nombres, j.apellidos,
                       c.nombre AS categoria_nombre
                FROM deudas d
                INNER JOIN jugadores j ON d.id_jugadores = j.id_jugadores
                LEFT JOIN categorias c ON j.id_categorias = c.id_categorias
                WHERE d.pago IN ('pendiente', 'mora')
                ORDER BY d.fecha_limite_pago DESC";

        return $this->query($sql);
    }
}
