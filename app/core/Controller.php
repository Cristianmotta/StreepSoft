<?php
declare(strict_types=1);

/* Controller - clase base para los contraladores */
class Controller
{
    protected PDO $pdo;
    protected string $viewPath = __DIR__ . '/../views';

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo;
    }

    /* Renderizar vistas con datos */
    protected function view(string $viewName, array $data = []): void
    {
        // Generar CSRF token
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $data['csrfToken'] = $_SESSION['csrf_token'];
    
        $data['isAuth'] = Auth::check();
        $data['authUser'] = Auth::user();
        $data['authName'] = Auth::nombre();
        $data['authId'] = Auth::id();

        extract($data);
    
        $viewFile = $this->viewPath . '/' . $viewName . '.php';
        
        if (!file_exists($viewFile)) {
            throw new Exception("Vista no encontrada: $viewFile");
        }
    
        require $viewFile;
    }

    /* Rediriguir a uan ruta */

    protected function redirect(string $path): void
    {
        header('Location: ' . $path);
        exit;
    }

    protected function validateCSRFToken(string $token): bool
    {
        if (empty($token) || empty($_SESSION['csrf_token'])){
            return false;
        }

        return hash_equals($_SESSION['csrf_token'], $token);
    }

    /* Retorna datos como json (para APIs) */
    protected function json(array $data, int $statusCode = 200): void
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

}