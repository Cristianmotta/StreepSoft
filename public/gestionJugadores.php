<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/controllers/JugadorController.php';

$action = $_GET['action'] ?? 'index';
$controller = new JugadorController();

if ($action === 'eliminar') {
    $controller->eliminar();
} else {
    $controller->index();
}