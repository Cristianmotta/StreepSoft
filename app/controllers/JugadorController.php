<?php
declare(strict_types=1);

require_once __DIR__. '/../../config/database.php';
require_once __DIR__. '/../../app/models/Jugador.php';

class JugadorController {
    
   public function index(){  
        global $pdo;

        $jugadorModel = new Jugador($pdo);
        $jugadores = $jugadorModel->obtenerTodos();   // ← array con los datos

        
        // Incluir la vista correcta (cuidado con mayúsculas/minúsculas)
        require_once __DIR__ . '/../views/jugadores/gestionJugadores/index.php';
   } 

   public function eliminar(): void
    {
        global $pdo;

        // Verificar que el ID llegue por POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id_jugadores'])) {
            // Redirigir a la lista si no hay ID válido
            header('Location: gestionJugadores.php');
            exit;
        }

        $id = (int) $_POST['id_jugadores'];

        // Instanciar el modelo y eliminar
        require_once __DIR__ . '/../models/Jugador.php';  // Si no se cargó antes
        $jugadorModel = new Jugador($pdo);
        $jugadorModel->eliminar($id);

        // Redirigir para evitar reenvío del formulario
        header('Location: gestionJugadores.php');
        exit;
    }
       
    
}


?>