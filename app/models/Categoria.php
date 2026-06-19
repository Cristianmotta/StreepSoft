<?php

declare(strict_types=1);

class Categoria
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function obtenerTodas(): array
    {
        $stmt = $this->pdo->query("SELECT id_categorias, nombre FROM categorias ORDER BY nombre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}