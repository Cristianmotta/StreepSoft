<?php
declare(strict_types=1);

/**
 * PublicController - Controla la página pública (inicio)
 * 
 * ¿Qué hace?
 * - Muestra la página de inicio (tu slider actual)
 * - No requiere autenticación
 */
class PublicController extends Controller
{
    /**
     * Mostrar la página de inicio
     * 
     * Este método se ejecuta cuando alguien accede a /
     * Obtiene los datos necesarios y renderiza la vista
     */
    public function home(): void
    {
        // Aquí puedes obtener datos si lo necesitas
        // Ejemplo: últimas noticias, eventos, etc.
        
        // Renderizar la vista home/index.php
        // Pasamos datos vacíos [] porque la página de inicio no necesita datos dinámicos
        $this->view('home/index', []);
    }
}