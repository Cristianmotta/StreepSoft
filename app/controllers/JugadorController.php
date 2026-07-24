<?php
declare(strict_types=1);

/**
 * JugadorController - Controla todas las acciones de jugadores
 * 
 * ¿Qué hace?
 * - Muestra lista de jugadores
 * - Muestra deudas de jugadores
 * - Procesa creación, actualización, eliminación
 */
class JugadorController extends Controller
{
    /**
     * Modelo de jugador
     * Lo usaremos para obtener datos de la BD
     */
    private Jugador $jugadorModel;

    /**
     * Constructor
     * 
     * @param PDO $pdo - Conexión a la base de datos
     */
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);  // Llamar al constructor de Controller
        $this->jugadorModel = new Jugador($pdo);  // Crear instancia del modelo
    }

    /**
     * Mostrar lista de jugadores en gestión
     * 
     * Se ejecuta cuando accedes a /jugadores/gestion
     */
    public function gestion(): void
    {
        // Obtener todos los jugadores del modelo
        $jugadores = $this->jugadorModel->obtenerTodos();

        // Enviar datos a la vista
        $this->view('jugadores/gestionJugadores/index', [
            'jugadores' => $jugadores,
            'titulo' => 'Gestión de Jugadores'
        ]);
    }

    /**
     * Mostrar deudas de jugadores
     * 
     * Se ejecuta cuando accedes a /jugadores/deudas
     */
    public function deudas(): void
    {
        // Obtener solo jugadores con deuda
        $jugadores = $this->jugadorModel->obtenerConDeuda();

        // Enviar datos a la vista
        $this->view('jugadores/deudasJugadores/index', [
            'jugadores' => $jugadores,
            'titulo' => 'Deudas de Jugadores'
        ]);
    }

    /**
     * Mostrar formulario para crear nuevo jugador
     * 
     * Se ejecuta cuando accedes a /jugadores/crear (GET)
     */
    public function crear(): void
    {
        $this->view('jugadores/crear', [
            'titulo' => 'Crear Jugador'
        ]);
    }

    /**
     * Guardar un nuevo jugador
     * 
     * Se ejecuta cuando envías el formulario (POST)
     */
    public function guardar(): void
    {
        // Verificar que sea POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/jugadores/crear');
        }

        // Validar CSRF
        if (!$this->validateCSRFToken($_POST['_token'] ?? '')) {
            $this->redirect('/jugadores/crear?error=csrf');
        }

        // Obtener y validar datos
        $datos = [
            'nombres' => trim($_POST['nombres'] ?? ''),
            'apellidos' => trim($_POST['apellidos'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'id_categoria' => (int)($_POST['id_categoria'] ?? 0),
        ];

        // Validar que los campos no estén vacíos
        if (empty($datos['nombres']) || empty($datos['apellidos'])) {
            $this->redirect('/jugadores/crear?error=campos_vacios');
        }

        // Crear el jugador
        if ($this->jugadorModel->crear($datos)) {
            $this->redirect('/jugadores/gestion?success=creado');
        } else {
            $this->redirect('/jugadores/crear?error=creacion_fallida');
        }
    }

    /**
     * Eliminar un jugador
     * 
     * @param int $id - ID del jugador a eliminar
     */
    public function eliminar(int $id): void
    {
        // Verificar que sea POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/jugadores/gestion');
        }

        // Validar CSRF
        if (!$this->validateCSRFToken($_POST['_token'] ?? '')) {
            $this->redirect('/jugadores/gestion?error=csrf');
        }

        // Eliminar el jugador
        if ($this->jugadorModel->eliminar($id)) {
            $this->redirect('/jugadores/gestion?success=eliminado');
        } else {
            $this->redirect('/jugadores/gestion?error=eliminacion_fallida');
        }
    }
}