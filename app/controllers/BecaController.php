<?php

declare(strict_types=1);

class BecaController extends Controller
{
    private jugador $jugadorModel;

    //Tipos de beca a porcentajes
    private const TIPOS_BECA = [
        'sin_beca' => 0,
        'beca_25' => 25,
        'media_beca' => 50,
        'beca_completa' => 100,
    ];

    //Porcentajes validos
    private const PORCENTAJES_VALIDOS = [0,25,50,100];


    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->jugadorModel = new Jugador($pdo);
    }


    public function listar(): void 
    {
        $jugadores = $this->jugadorModel->obtenerTodosConBeca();

        // Calcular estadísticas rápidas
        $estadisticas = $this->calcularEstadisticas($jugadores);

        $this->view('becas/listar',[
            'jugadores' => $jugadores,
            'estadisticas' => $estadisticas,
            'tiposBeca' => self::TIPOS_BECA,
            'titulo' => 'Gestión de Becas'
        ]);
    }

    //Mostrar formulario para asignar beca a un jugador especifico

    public fuction asignar(int $id): void
    {
        $jugador = $this->jugadorModel->obtenerPorId($id);

        if(!$jugador) {
            $_SESSION['error'] = "Jugador no encontrado.";
            $this->redirect('becas/listar');
            return;
        }

      // Validar que el porcentaje sea valido
        if(!in_array($porcentajeBeca, selft::PORCENTAJES_VALIDOS)) {
            $_SESSION['error'] = "Porcentaje de beca no válido. Debe ser 0, 25, 50 o 100.";
            $this->redirect('/becas/asignar' . $jugadorId);
            return;
        }

        // Obtener el tipo de beca correspondiente
        $tipoBeca = $this->porcentajeTipoBeca($porcentajeBeca);


         // Actualizar solo el campo tipo_beca
         $datos = ['tipo_beca' => $tipoBeca];

         if($this->jugadorModel->actualizar($jugadorId,$datos)) {
            $nombreCompleto = $jugador['nombre'] . ' ' . $jugador['apellido'];
            $_SESSION['success'] = "Beca del {$porcentajeBeca}% asignada asignada correctamente a {$nombreCompleto}.";
         }else{

        $_SESSION['error'] = "Error al asignar la beca.";
         }

        $this->redirect('/becas/listar');
        
    }


        // 

















    }










}




?>

