<?php
declare(strict_types=1);


// Esta clase se encarga de validar datos del jugador
class JugadorValidacion {

    private array $datos;
    private Jugador $jugadorModel;
    private array $errores = [];

    public function __construct(array $datos, Jugador $jugadorModel) {
        $this->datos        = $datos;
        $this->jugadorModel = $jugadorModel;
    }

    public function validar(int $excludeId = null): array {
        $this->validarCamposObligatorios();
        $this->validarDocumento($excludeId);
        $this->validarCamiseta($excludeId);
        return $this->errores;
    }

    private function validarCamposObligatorios(): void {
        if (empty($this->datos['apellido'])) {
            $this->errores[] = "El apellido es obligatorio.";
        }
        if (empty($this->datos['nombre'])) {
            $this->errores[] = "El nombre es obligatorio.";
        }
        if (empty($this->datos['documento'])) {
            $this->errores[] = "El documento es obligatorio.";
        }
    }

    private function validarDocumento(?int $excludeId): void {
        if (!empty($this->datos['documento'])) {
            if ($this->jugadorModel->documentoExiste($this->datos['documento'], $excludeId)) {
                $this->errores[] = "Ya existe un jugador con ese documento.";
            }
        }
    }

    private function validarCamiseta(?int $excludeId): void {
        if (!empty($this->datos['camiseta'])) {
            if ($this->jugadorModel->camisetaExiste($this->datos['camiseta'], $excludeId)) {
                $this->errores[] = "Ya existe un jugador con ese número de camiseta.";
            }
        }
    }
}