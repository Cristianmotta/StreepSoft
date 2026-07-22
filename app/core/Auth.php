<?php
declare(strict_types=1);

<<<<<<< HEAD
// Auth - Clae para menejar autenticacion
class Auth {

    // Verificar si el usuario esta autenticado 

    public static function check(): bool
    {
        return isset($_SESSION['usuario']) && is_array($_SESSION['usuario']);
    }

    // Registar un usuario
    public static function login(array $datos): void
    {
        $_SESSION['usuario'] = [
            'id' => $datos['id'] ?? null,
            'usuario' => $datos['usuario'] ?? null,
            'email' => $datos['email'] ?? null,
            'rol' => $datos['rol'] ?? 'usuario'
        ];

        error_log("Login exitoso: {$datos['usuario']}"); 
    }

    // obtener los datos dek usuario actual

    public static function user(): ?array
    {
        return $_SESSION['usuario'] ?? null;
    }

    // obtener por id
    public static function id(): ?int
    {
        return isset($_SESSION['usuario']['id']) 
            ? (int)$_SESSION['usuario']['id'] 
            : null;
    }

    // Obtener el ID del usuario actual
    public static function nombre(): ?string
    {
        return $_SESSION['usuario']['usuario'] ?? null;
    }

    // Obtener el email del usuario
    public static function email(): ?string
    {
        return $_SESSION['usuario']['email'] ?? null;
    }


    // cerrar la session completamente
    public static function logout(): void
    {
        
        $nombre = self::nombre();

        // Limpiar sesión
        $_SESSION = [];
        session_destroy();

        // Limpiar cookie
        if (ini_get("session.use_cokies")) {
=======
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
>>>>>>> upstream/developer
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
<<<<<<< HEAD
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Headers para evitar cache
        header("Cache-control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        
        error_log("Logout: $nombre");
    }

    // Verificar si es administrardor
    public static function isAdmin(): bool
    {
       return ($_SESSION['usuario']['rol'] ?? null) === 'admin';
    }

    // Obtener nombre para montar
    public static function displayName(): string
    {
        return self::check() ? (self::nombre() ?? 'Usuario') : 'Invitado';
    }

    // Requerir que esté logueado
    public static function requireLogin(string $redirectTo = '/login'): void
    {
       if (!self::check()) {
            // Guardar la página actual para redirigir después del login
            $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'] ?? '/';
            
            header('Location: ' . $redirectTo);
=======
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
>>>>>>> upstream/developer
            exit;
        }
    }

<<<<<<< HEAD
    public static function getRedirectTo(string $default = '/'): string
    {
        $redirect = $_SESSION['redirect_to'] ?? $default;
        unset($_SESSION['redirect_to']);  // Limpiar después de usar
        return $redirect;
=======
    // ─── OBTENER USUARIO ACTUAL ───
    public static function usuario(): array {
        return [
            'id'      => $_SESSION['usuario_id'] ?? null,
            'usuario' => $_SESSION['usuario'] ?? null,
            'nombre'  => $_SESSION['nombre'] ?? null
        ];
>>>>>>> upstream/developer
    }
}