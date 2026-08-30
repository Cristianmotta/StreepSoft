<?php
class PerfilAdminController extends Controller
{
    public function perfil(): void
    {
        $usuarioModel = new Usuario($this->pdo);
        $admin = $usuarioModel->obtenerPorId(Auth::id());

        $this->view('perfilAdmin/perfil', [
            'admin' => $admin
        ]);
    }
    public function actualizarPerfil(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/streepsoft/perfil/administrador');
            return;
        }

        $nombreCompleto = trim($_POST['nombre_completo'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $documentoIdentidad = trim($_POST['documento_identidad'] ?? '');

        if (empty($nombreCompleto) || empty($telefono) || empty($documentoIdentidad)) {
            $this->redirect('/streepsoft/perfil/administrador?error=campos_vacios');
            return;
        }

        // ---------- AQUÍ VAN LAS VALIDACIONES NUEVAS ----------
        if (!preg_match('/^[\p{L}\s]+$/u', $nombreCompleto)) {
            $this->redirect('/streepsoft/perfil/administrador?error=nombre_invalido');
            return;
        }

        if (!preg_match('/^[0-9]+$/', $telefono)) {
            $this->redirect('/streepsoft/perfil/administrador?error=telefono_invalido');
            return;
        }

        if (!preg_match('/^[0-9]+$/', $documentoIdentidad)) {
            $this->redirect('/streepsoft/perfil/administrador?error=documento_invalido');
            return;
        }

        $usuarioModel = new Usuario($this->pdo);

        if ($usuarioModel->actualizarPerfil(Auth::id(), $nombreCompleto, $telefono, $documentoIdentidad)) {
            $this->redirect('/streepsoft/perfil/administrador?success=actualizado');
        } else {
            $this->redirect('/streepsoft/perfil/administrador?error=actualizacion_fallida');
        }
    }
}
