<?php
declare(strict_types=1);

<<<<<<< HEAD
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
=======
require_once __DIR__ . '/../../app/models/Jugador.php';
require_once __DIR__ . '/../../app/helpers/JugadorValidacion.php';

class JugadorController {

    private Jugador $jugadorModel;

    // D — Dependency Inversion
    // El modelo se inyecta desde afuera
    public function __construct(Jugador $jugadorModel) {
        $this->jugadorModel = $jugadorModel;
    }

    // ─── LISTAR JUGADORES ───
    // S — Solo coordina, no consulta BD directamente
    public function index(): void {
        Auth::requerirLogin();
        $jugadores = $this->jugadorModel->obtenerTodos();
        require_once __DIR__ . '/../views/jugadores/gestionJugadores/index.php';
    }

    // ─── MOSTRAR FORMULARIO NUEVO JUGADOR ───
    public function create(): void {
        Auth::requerirLogin();
        $instructores = $this->jugadorModel->getInstructores();
        require_once __DIR__ . '/../views/jugadores/gestionJugadores/create.php';
    }

    // ─── GUARDAR NUEVO JUGADOR ───
    public function store(): void {
        // S — La validación va en una clase separada
        Auth::requerirLogin();
        $validacion = new JugadorValidacion($_POST, $this->jugadorModel);
        $errores    = $validacion->validar();

        if (!empty($errores)) {
            $error        = $errores[0];
            $instructores = $this->jugadorModel->getInstructores();
            require_once __DIR__ . '/../views/jugadores/gestionJugadores/create.php';
            return;
        }

        $jugador_id = $this->jugadorModel->create([
            ':apellido'          => trim($_POST['apellido']),
            ':nombre'            => trim($_POST['nombre']),
            ':talla'             => trim($_POST['talla'] ?? ''),
            ':iniciales'         => trim($_POST['iniciales'] ?? ''),
            ':camiseta'          => $_POST['camiseta'] ?: null,
            ':fecha_nacimiento'  => $_POST['fecha_nacimiento'] ?: null,
            ':edad'              => $_POST['edad'] ?: null,
            ':documento'         => trim($_POST['documento']),
            ':celular_acudiente' => trim($_POST['celular_acudiente'] ?? ''),
            ':instructor_id'     => $_POST['instructor_id'] ?: null,
            ':eps'               => trim($_POST['eps'] ?? ''),
            ':fecha_inscripcion' => $_POST['fecha_inscripcion'] ?: null,
            ':tipo_beca'         => $_POST['tipo_beca'] ?? 'sin_beca'
        ]);

        // Crear registro de documentos automáticamente
        $this->jugadorModel->crearDocumentos($jugador_id);

        header('Location: /streepsoft/public/jugadores');
        exit;
    }

    // ─── MOSTRAR FORMULARIO EDITAR ───
    public function edit(int $id): void {
        Auth::requerirLogin();
        $jugador = $this->jugadorModel->find($id);

        if (!$jugador) {
            header('Location: /streepsoft/public/jugadores');
            exit;
        }

        $instructores = $this->jugadorModel->getInstructores();
        require_once __DIR__ . '/../views/jugadores/gestionJugadores/edit.php';
    }

    // ─── ACTUALIZAR JUGADOR ───
    public function update(int $id): void {
        Auth::requerirLogin();
        $validacion = new JugadorValidacion($_POST, $this->jugadorModel);
        $errores    = $validacion->validar($id);

        if (!empty($errores)) {
            $error        = $errores[0];
            $jugador      = $this->jugadorModel->find($id);
            $instructores = $this->jugadorModel->getInstructores();
            require_once __DIR__ . '/../views/jugadores/gestionJugadores/edit.php';
            return;
        }

        $this->jugadorModel->update($id, [
            ':apellido'          => trim($_POST['apellido']),
            ':nombre'            => trim($_POST['nombre']),
            ':talla'             => trim($_POST['talla'] ?? ''),
            ':iniciales'         => trim($_POST['iniciales'] ?? ''),
            ':camiseta'          => $_POST['camiseta'] ?: null,
            ':fecha_nacimiento'  => $_POST['fecha_nacimiento'] ?: null,
            ':edad'              => $_POST['edad'] ?: null,
            ':documento'         => trim($_POST['documento']),
            ':celular_acudiente' => trim($_POST['celular_acudiente'] ?? ''),
            ':instructor_id'     => $_POST['instructor_id'] ?: null,
            ':eps'               => trim($_POST['eps'] ?? ''),
            ':fecha_inscripcion' => $_POST['fecha_inscripcion'] ?: null,
            ':tipo_beca'         => $_POST['tipo_beca'] ?? 'sin_beca',
            ':estado'            => $_POST['estado'] ?? 'activo'
        ]);

        header('Location: /streepsoft/public/jugadores');
        exit;
    }

    // ─── CAMBIAR ESTADO ───
    public function cambiarEstado(int $id): void {
        Auth::requerirLogin();
        $estado = trim($_POST['estado'] ?? '');

        if (!in_array($estado, ['activo', 'inactivo', 'retirado'])) {
            header('Location: /streepsoft/public/jugadores');
            exit;
        }

        $this->jugadorModel->cambiarEstado($id, $estado);
        header('Location: /streepsoft/public/jugadores');
        exit;
    }

    // ─── VER DETALLE ───
    public function show(int $id): void {
        Auth::requerirLogin();
        $jugador    = $this->jugadorModel->find($id);
        $documentos = $this->jugadorModel->getDocumentos($id);

        if (!$jugador) {
            header('Location: /streepsoft/public/jugadores');
            exit;
        }

        require_once __DIR__ . '/../views/jugadores/gestionJugadores/show.php';
    }

    // ─── ELIMINAR JUGADOR ───
    public function eliminar(): void {
        Auth::requerirLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id_jugadores'])) {
            header('Location: /streepsoft/public/jugadores');
            exit;
        }

        $id = (int) $_POST['id_jugadores'];
        $this->jugadorModel->eliminar($id);

        header('Location: /streepsoft/public/jugadores');
        exit;
    }
>>>>>>> upstream/developer
}