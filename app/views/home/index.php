<?php
    // Quick login SOLO si:
    // 1. Existe cookie quick_login_data (no sesión)
    // 2. NO fue logout manual (no existe cookie logout_manual)
    $quickLoginDisponible = (
        isset($_COOKIE['quick_login_data']) &&
        !isset($_COOKIE['logout_manual'])
    );

    // Debug
    error_log("Home - quickLoginDisponible: " . ($quickLoginDisponible ? 'true' : 'false'));
    error_log("Home - COOKIE quick_login_data: " . (isset($_COOKIE['quick_login_data']) ? 'true' : 'false'));
    error_log("Home - COOKIE logout_manual: " . (isset($_COOKIE['logout_manual']) ? 'true' : 'false'));

    $remainingMs = 0;
    if ($quickLoginDisponible) {
        $quickData = SessionTimeout::getQuickLoginData();
        $remainingMs = $quickData ? max(0, ($quickData['expires_at'] - time()) * 1000) : 0;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Streepsotf</title>
    <link rel="stylesheet" href="/streepsoft/public/css/homepanel/index.css">
</head>
<body>
    <div class="nav-des">
        <nav>
            <img src="/streepsoft/public/Image/copColombiaInternacional.svg" alt="CopColombia">
            
            <?php if ($quickLoginDisponible): ?>
                <form method="POST" action="<?= url('/quick-login') ?>" style="display:inline;">
                    <input type="hidden" name="_token" value="<?= htmlspecialchars($csrfToken ?? '') ?>">
                    <button type="submit" class="iniciar">
                        Inicio rapido
                    </button>
                </form>
            <?php else: ?>
                <a href="<?= url('/login') ?>">
                    <button class="iniciar">
                        Iniciar Sesión
                    </button>
                </a>
            <?php endif; ?>
            
        </nav>
        <div class="linea"></div>
    </div>
    <div class="des" >
        <div class="imagenes">

            <div class="slide">
                <img src="/streepsoft/public/Image/collaege.png" alt="imagen-1">
                <div class="overlay">
                    <h1><span>Cop</span>&nbsp;<span>Co</span>lombia</h1>
                    <p>!Cumpliendo Sueños he ilusiones!</p>
                </div>
            </div>

            <div class="slide">
                <img src="/streepsoft/public/Image/collaege-2.png" alt="imagen-2">
                <div class="overlay">
                    <h1>Entren<span>amiento</span> profesional</h1>
                    <p>Supera tus límites cada día</p>
                </div>
            </div>

            <div class="slide">
                <img src="/streepsoft/public/Image/collaege-3.jpg" alt="imagen-3">
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
                <img src="/streepsoft/public/Image/collaege-4.jpg" alt="imagen-5">
            </div>

            <div class="vi-imagen-derecha">
                <div class="vi-imagen">
                    <img src="/streepsoft/public/Image/collaege-7.jpeg" alt="imagen-6">
                </div>

                <div class="vi-imagen">
                    <img src="/streepsoft/public/Image/collaege-6.jpeg" alt="imagen-7">
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
                <img src="/streepsoft/public/Image/collaege-8.png" alt="imagen-8">
            </div>

            <div class="mi-img">
                <img src="/streepsoft/public/Image/collaege-9.jpg" alt="imagen-9">
            </div>

            <div class="mi-img">
                <img src="/streepsoft/public/Image/collaege-10.avif" alt="imagen-10">
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-copy">
            <p>© 2026 Streepsotf - <span>CopCo</span>lombia - Todos los derechos reservados</p>
        </div>
    </footer>
    
    <?php if ($quickLoginDisponible): ?>
    <script>
        const QUICK_LOGIN_REMAINING = 87000; // ejemplo: 87 segundos restantes
        setTimeout(() => { window.location.reload(); }, QUICK_LOGIN_REMAINING);
    </script>
    <?php endif; ?>
</body>    
    <script src="/streepsoft/public/js/main/main.js"></script>
</html>