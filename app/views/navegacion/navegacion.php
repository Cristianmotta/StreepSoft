<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nav | streepsooft </title>
</head>
<body>
    <div class="navbar">
        <nav class="main-navbar">
            <div class="navbar-group">
                <a href="#" class="navbar-item" title="Usuario">
                    <img src="/streepsoft/public/Image/usuario.png" alt="usuario" class="navbar-icon">
                </a>
                <a href="#" class="navbar-item" title="Notificaciones">
                    <img src="/streepsoft/public/Image/notifica.png" alt="notifica" class="navbar-icon">
                </a>
            </div>

            <div class="navbar-group">
                <div class="navbar-logo">
                    <img src="/streepsoft/public/Image/CopColombiaInternacional.png" alt="logo">
                </div>
                <button class="navbar-item btn-menu" onclick="toggleMenu()" aria-label="Abrir menú">
                    <img src="/streepsoft/public/Image/menu.png" alt="hamburguesa" class="navbar-icon">
                </button>
            </div>
        </nav>
        <div class="linea"></div>
    </div>
    
    <div id="side-menu" class="sidebar">
        <div class="sidebar-header">
            <img src="/streepsoft/public/Image/CopColombiaInternacional.png" alt="logo" class="sidebar-logo">
            <button class="close-icon-btn" onclick="toggleMenu()">
                <img src="/streepsoft/public/Image/menu.png" alt="cerrar">
            </button>
        </div>

        <nav class="sidebar-links">
            <a href="/streepsoft/dashboard">Estadísticas</a>
            <a href="/streepsoft/jugadores/gestionJugadores">Gestión de alumnos</a>
            <a href="/streepsoft/jugadores/deudas">Deudas</a>
            <a href="/streepsoft/perfilJugador">Perfil de alumnos</a>
            <a href="#">Actualización de datos</a>
            <a href="#">Registro de deuda</a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="/streepsoft/logout" onsubmit="return confirm('¿Realmente deseas cerrar sesión?');">
                <input type="hidden" name="_token" value="<?php echo htmlspecialchars($csrfToken ?? ''); ?>">
                <button type="submit" class="btn-cerrar-sesion">Cerrar sesión</button>
            </form>
        </div>
    </div>

    <div id="overlay" class="overlay" onclick="toggleMenu()"></div>

</body>
</html>