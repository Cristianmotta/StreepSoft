<?php
declare(strict_types=1);

// SessionTimeout - Gestiona timeout de sesión

class SessionTimeout 
{
    // 10 minutos en segundos
    const TIMEOUT = 600;

    // 2 minutos para quick login
    const QUICK_LOGIN_TIMEOUT = 120;

    // VERIFICAR EL TIMEOUT
    public static function check(): void
    {
        if(!Auth::check()){
            return;
        }

        // Obtner timestamp de ultima actividad
        $lastActivity = $_SESSION['last_activity'] ?? time();
        $currentTime = time();
        $difference = $currentTime - $lastActivity;

        // si pasaron mas de 10 minutos
        if ($difference > self::TIMEOUT) {
            // guardar datos para quick login
            self::saveQuitckLoginData();

           // cerrar sesion
           $nombreUsuario = Auth::nombre();
           $_SESSION = [];
           session_destroy();

           error_log("Session expirada por timeout: $nombreUsuario");

            header('Location: /streepsoft/?quickAvailable=1');
            exit;
        }

        $_SESSION['last_activity'] = $currentTime;
    }

    public static function saveQuitckLoginData(): void
    {
        $usuario = Auth::user();

        if ($usuario) {
            $_SESSION['quick_login'] = [
                'usuario_id' => $usuario['id'],
                'usuario_nombre' => $usuario['usuario'],
                'usuario_email' => $usuario['email'] ?? null,
                'timestamp' => time(),
                'expires_at' => time() + self::QUICK_LOGIN_TIMEOUT
            ];
        }
    }

    // Verificar si quick login está disponible
    public static function isQuickLoginAvailable(): bool
    {
        if (!isset($_SESSION['quick_login'])) {
            return false;
        }

        $quickLogin = $_SESSION['quick_login'];
        $currentTime = time();

        // Si expiro (pasaron más de 2 minutos)
        if ($currentTime > $quickLogin['expires_at']){
            unset($_SESSION['quick_login']);
            return false;
        }

        return true;
    }

    // Obtener datos de quick login
    public static function getQuickLoginData(): ?array
    {
        if (self::isQuickLoginAvailable()) {
            return $_SESSION['quick_login'];
        }
        return null; 
    }

    // Limpiar quick login
    public static function clearQuickLogin(): void
    {
        unset($_SESSION['quick_login']);
    }

}
