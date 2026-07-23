<?php




define('BASE_URL', 'http://localhost/streepsoft/');
require_once '../config/database.php';
require_once '../app/core/Auth.php';
require_once '../app/models/Jugador.php';
require_once '../app/controllers/JugadorController.php';


$jugadorModel      = new Jugador($pdo);
$jugadorController = new JugadorController($jugadorModel);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Streepsoft</title>
    <link rel="stylesheet" href="./css/homepanel/index.css">
    <link rel="shortcut icon" href="./assets/img/logofavi.ico" type="image/x-icon">
    
</head>
<body>
    <div class="nav-des">
        <nav>
            <img src="./Image/copColombiaInternacional.svg" alt="CopColombia">
            <button class="iniciar"><a href="<?= BASE_URL ?>app/views/auth/login.php">Iniciar Sesión</a></button>
        </nav>
        <div class="linea"></div>
    </div>

    <div class="des">
        <div class="imagenes">

            <div class="slide">
                <img src="./Image/collaege.png" alt="imagen-1">
                <div class="overlay">
                    <h1><span>Cop</span>&nbsp;<span>Co</span>lombia</h1>
                    <p>!Cumpliendo Sueños he ilusiones!</p>
                </div>
            </div>

            <div class="slide">
                <img src="./Image/collaege-2.png" alt="imagen-2">
                <div class="overlay">
                    <h1>Entren<span>amiento</span> profesional</h1>
                    <p>Supera tus límites cada día</p>
                </div>
            </div>

            <div class="slide">
                <img src="./Image/collaege-3.jpg" alt="imagen-3">
                <div class="overlay">
                    <h1>Haz historia</h1>
                    <p>El esfuerzo define tu camino</p>
                </div>
            </div>
        </div>

        <button class="botton prev">⟨</button>
        <button class="botton next">⟩</button>

        <div class="indicadores"></div>
    </div>

    <div class="vision">
        <div class="Vi-des">
            <h1>Vi<span>si</span>ón</h1>
            <p>Ser una organización social líder a nivel nacional e internacional, en el cumplimiento de sueños de NNA,
                comprometida con la igualdad de oportunidades, mediante alianzas estratégicas que multipliquen el
                impacto en nuestros programas y actividades que promuevan la implementación de ODS.</p>
        </div>

        <div class="vi-imagenes">

            <div class="vi-imagen">
                <img src="./Image/collaege-4.jpg" alt="imagen-5">
            </div>

            <div class="vi-imagen-derecha">
                <div class="vi-imagen">
                    <img src="./Image/collaege-7.jpeg" alt="imagen-6">
                </div>

                <div class="vi-imagen">
                    <img src="./Image/collaege-6.jpeg" alt="imagen-7">
                </div>
            </div>


        </div>
    </div>

    <div class="mision">
        <div class="mi-des">
            <h1><span>Mi</span>sión</h1>
            <p>Somos una organización con enfoque social, deportivo, educativo y de cultura de Paz, que utiliza
                diferentes estrategias en sinergia con los ODS para mitigar y combatir flagelos en los que se ven
                expuestos NNAJ en Colombia.</p>
        </div>

        <div class="mi-imagenes">
            <div class="mi-img">
                <img src="./Image/collaege-8.png" alt="imagen-8">
            </div>

            <div class="mi-img">
                <img src="./Image/collaege-9.jpg" alt="imagen-9">
            </div>

            <div class="mi-img">
                <img src="./Image/collaege-10.avif" alt="imagen-10">
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-copy">
            <p>© 2026 Streepsoft - <span>CopCo</span>lombia - Todos los derechos reservados</p>
        </div>
    </footer>


    <script src="/streepsoft/public/js/main.js"></script>
</body>
</html>