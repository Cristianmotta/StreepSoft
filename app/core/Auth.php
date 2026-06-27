<?php
declare(strict_types=1);

class Auth {

    // ─── INICIAR SESIÓN ───
    public static function login(array $usuario): void {
        session_start();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario']    = $usuario['usuario'];
        $_SESSION['nombre']     = $usuario['nombre'];
    }

    // ─── DESTRUCTOR DE SESIÓN ───
    public static function logout(): void {
        session_start();
        
        // Elimina todas las variables de sesión
        $_SESSION = [];
        
        // Elimina la cookie de sesión
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        // Destruye la sesión completamente
        session_destroy();

        header('Location: ' . BASE_URL . 'login');
        exit;
    }

    // ─── VERIFICAR SI HAY SESIÓN ACTIVA ───
    public static function check(): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['usuario_id']);
    }

    // ─── PROTEGER RUTAS ───
    public static function requerirLogin(): void {
        if (!self::check()) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }

    // ─── OBTENER USUARIO ACTUAL ───
    public static function usuario(): array {
        return [
            'id'      => $_SESSION['usuario_id'] ?? null,
            'usuario' => $_SESSION['usuario'] ?? null,
            'nombre'  => $_SESSION['nombre'] ?? null
        ];
    }
}