<?php 

declare(strict_types=1);

class MatriculaController extends Controller
{
    private Matricula $matriculaModel;
    private Jugador $jugadorModel;



    
        ]);
    }



    //Mostrar Formulario Para Registrar Matricula
     public function registrarForm(): void
    {
        $jugadores = $this->matriculaModel->obtenerMorososMatricula();
        $valorMatricula = $this->matriculaModel->getValorMatricula();

        $this->view('matricula/registrar', [
            'jugadores' => $jugadores,
            'valorMatricula' => $valorMatricula,
            'titulo' => 'Registrar Matricula'
        ]);
    }

    //Guardar Nueva Matricula






}












?>