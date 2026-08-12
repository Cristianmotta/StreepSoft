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
    private Categoria $categoriaModel;
    private Instructor $instructorModel;
    private Eps $epsModel;
    private TipoDocumento $tipoDocumentoModel;
    private Documento $documentoModel;

    /**
     * Constructor
     */
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);  // Llamar al constructor de Controller
        $this->jugadorModel = new Jugador($pdo);
        $this->categoriaModel = new Categoria($pdo);
        $this->instructorModel = new Instructor($pdo);
        $this->epsModel = new Eps($pdo);
        $this->tipoDocumentoModel = new TipoDocumento($pdo);
        $this->documentoModel = new Documento($pdo);
    }

    /**
     * Mostrar lista de jugadores en gestión
     * 
     * Se ejecuta cuando accedes a /jugadores/gestion
     */
    public function gestion(): void
    {
        // Obtener todos los jugadores del modelo
        try {
            $jugadores = $this->jugadorModel->obtenerTodos();
        } catch (Exception $e) {
            error_log("Gestion jugadiores: " . $e->getMessage());
            $jugadores = [];
        }
        

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
        try {
            $jugadores = $this->jugadorModel->obtenerConDeuda();
        } catch (Exception $e){
            error_log("Deudas jugadores: " . $e->getMessage());
            $jugadores = [];
        }
        

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
        // ANTES esto apuntaba a 'jugadores/crear', pero ese archivo no
        // existe: la vista real vive en 'jugadores/gestionJugadores/create'.
        // Por eso Controller::view() lanzaba una Exception ("Vista no
        // encontrada") que terminaba mostrando "Error en la aplicación".
        try {
            $categorias = $this->categoriaModel->obtenerTodas();
            $instructores = $this->instructorModel->obtenerTodos();
            $epsList = $this->epsModel->obtenerTodas();
            $tiposDocumento = $this->tipoDocumentoModel->obtenerTodos();
        } catch (Exception $e) {
            error_log("Crear jugador (cargar catálogos): " . $e->getMessage());
            $categorias = [];
            $instructores = [];
            $epsList = [];
            $tiposDocumento = [];
        }

        $this->view('jugadores/gestionJugadores/create', [
            'titulo' => 'Crear Jugador',
            'categorias' => $categorias,
            'instructores' => $instructores,
            'epsList' => $epsList,
            'tiposDocumento' => $tiposDocumento,
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

        // Validar CSRF (el formulario ahora incluye el campo oculto _token)
        if (!$this->validateCSRFToken($_POST['_token'] ?? '')) {
            $this->redirect('/jugadores/crear?error=csrf');
        }

        // ------------------------------------------------------------
        // 1) Recoger y limpiar los datos de texto del formulario
        //    (trim() quita espacios sobrantes al inicio/final)
        //
        //    El formulario tiene 4 campos de nombre (primer/segundo
        //    nombre y apellido) pero la tabla `jugadores` solo tiene
        //    UNA columna `nombres` y UNA columna `apellidos`, así que
        //    los combinamos aquí antes de guardar.
        // ------------------------------------------------------------
        $nombre1 = trim($_POST['nombre1'] ?? '');
        $nombre2 = trim($_POST['nombre2'] ?? '');
        $apellido1 = trim($_POST['apellido1'] ?? '');
        $apellido2 = trim($_POST['apellido2'] ?? '');

        $datos = [
            'nombres'          => trim($nombre1 . ' ' . $nombre2),
            'apellidos'        => trim($apellido1 . ' ' . $apellido2),
            'fecha_nacimiento' => trim($_POST['fecha_nacimiento'] ?? ''),
            'acudiente'        => trim($_POST['acudiente'] ?? ''),
            'numero_acudiente' => trim($_POST['numero_acudiente'] ?? ''),
            'iniciales'        => trim($_POST['iniciales'] ?? ''),
            'id_categorias'    => (int) ($_POST['id_categorias'] ?? 0),
            'id_eps'           => (int) ($_POST['id_eps'] ?? 0),
            'id_instructor'    => (int) ($_POST['id_instructor'] ?? 0),
        ];

        $documentoNumero = trim($_POST['documento'] ?? '');
        $idTipoDocumento = (int) ($_POST['id_tipo_documento'] ?? 0);

        // ------------------------------------------------------------
        // 2) Validar los campos obligatorios (NOT NULL en la BD)
        //    Si falta algo, no llegamos ni a tocar la base de datos.
        // ------------------------------------------------------------
        $obligatorios = [
            'nombres', 'apellidos', 'fecha_nacimiento',
            'acudiente', 'numero_acudiente',
        ];

        foreach ($obligatorios as $campo) {
            if ($datos[$campo] === '') {
                $this->redirect('/jugadores/crear?error=campos_vacios');
            }
        }

        if ($datos['id_categorias'] <= 0 || $datos['id_eps'] <= 0 || $datos['id_instructor'] <= 0) {
            $this->redirect('/jugadores/crear?error=campos_vacios');
        }

        // Validar que la fecha de nacimiento tenga formato correcto y no sea futura
        $fecha = DateTime::createFromFormat('Y-m-d', $datos['fecha_nacimiento']);
        if (!$fecha || $fecha > new DateTime()) {
            $this->redirect('/jugadores/crear?error=fecha_invalida');
        }

        // ------------------------------------------------------------
        // 3) Subir la foto de forma segura (es opcional en la BD)
        // ------------------------------------------------------------
        try {
            $nombreFoto = $this->subirFotoJugador($_FILES['foto'] ?? null);
        } catch (Exception $e) {
            error_log("Guardar jugador (foto): " . $e->getMessage());
            $this->redirect('/jugadores/crear?error=' . urlencode($e->getMessage()));
        }
        $datos['foto'] = $nombreFoto;

        // ------------------------------------------------------------
        // 4) Guardar en la base de datos DENTRO de una transacción:
        //    si falla el insert de documentos, deshacemos también el
        //    del jugador (todo o nada, para no dejar datos a medias).
        // ------------------------------------------------------------
        try {
            $this->pdo->beginTransaction();

            $idJugador = $this->jugadorModel->crear($datos);

            if ($idJugador === 0) {
                throw new Exception('No se pudo crear el jugador');
            }

            $this->documentoModel->crear($idJugador, $documentoNumero ?: null, $idTipoDocumento ?: null);

            $this->pdo->commit();

            $this->redirect('/streepsoft/jugadores/gestion?success=creado');
        } catch (Exception $e) {
            $this->pdo->rollBack();
            error_log("Guardar jugador: " . $e->getMessage());
            $this->redirect('/streepsoft/jugadores/gestion?error=creacion_fallida');
        }
    }

    /**
     * Subir la foto del jugador de forma segura
     */
    private function subirFotoJugador(?array $archivo): ?string
    {
        // Si el usuario no seleccionó ningún archivo, no es un error
        if (!$archivo || $archivo['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if ($archivo['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Error al subir la foto');
        }

        $tamanoMaximo = 2 * 1024 * 1024; // 2 MB
        if ($archivo['size'] > $tamanoMaximo) {
            throw new Exception('La foto supera el tamaño máximo de 2MB');
        }

        // Detectar el tipo MIME real leyendo el contenido del archivo
        $tiposPermitidos = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
        ];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($archivo['tmp_name']);

        if (!isset($tiposPermitidos[$mime])) {
            throw new Exception('Formato de imagen no permitido (solo JPG o PNG)');
        }

        $carpetaDestino = __DIR__ . '/../../public/Image/jugadores';
        if (!is_dir($carpetaDestino)) {
            mkdir($carpetaDestino, 0755, true);
        }

        // Nombre de archivo aleatorio y seguro (nunca el nombre original)
        $nombreArchivo = bin2hex(random_bytes(16)) . '.' . $tiposPermitidos[$mime];

        if (!move_uploaded_file($archivo['tmp_name'], $carpetaDestino . '/' . $nombreArchivo)) {
            throw new Exception('No se pudo guardar la foto en el servidor');
        }

        return $nombreArchivo;
    }

    /**
     * Eliminar un jugador
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


    public function perfil(): void
    {
        $jugadores = $this->jugadorModel->obtenerTodos();

        $this->view('perfilJugador/index', [
            'titulo' => 'Perfil de Alumnos',
            'jugadores' => $jugadores
        ]);
    }
}