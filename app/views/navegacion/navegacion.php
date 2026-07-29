<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nav | streepsooft </title>
    <link rel="stylesheet" href="/streepsoft/public/css/hamburguesa">
    <style>
        :root {
            /* Variables para facilitar cambios rápidos */
            --navbar-height: 84px;
            --icon-size: 55px;
            --padding-sides: 20px;
            --navbar-bg: #212020;
            --gold-main: #D09E10;
            --dark-bg: #111111;
            --text-white: #ffffff;
            --card-bg: #D09E10;
            --text-color: #ffffff;
            --danger-red: #5a0000;
            --sidebar-bg: #000000;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #141414;
            overflow-x: hidden;
        }

        /* --- BARRA DE NAVEGACIÓN --- */
        .main-navbar {
            background: var(--navbar-bg);
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: var(--navbar-height);
            padding: 0 var(--padding-sides);
            width: 100%;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 2px solid var(--gold-main);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .navbar-group {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar-icon {
            width: var(--icon-size);
            height: var(--icon-size);
            object-fit: contain;
            transition: all 0.3s ease;
        }

        .navbar-item:hover .navbar-icon {
            transform: scale(1.1);
            filter: drop-shadow(0 0 5px var(--gold-main));
        }

        .navbar-logo img {
            height: 70px;
            width: auto;
            display: block;
            transition: height 0.3s ease;
        }

        .btn-menu {
            background: none;
            border: none;
            cursor: pointer;
            outline: none;
        }

        /* --- SIDEBAR (Panel Lateral) --- */
        .sidebar {
            height: 100vh;
            width: 340px;
            max-width: 100vw;
            position: fixed;
            z-index: 2000;
            top: 0;
            right: -100%;
            background-color: var(--sidebar-bg);
            transition: all 0.1s cubic-bezier(0.77, 0, 0.175, 1);
            display: flex;
            flex-direction: column;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.7);
        }

        /* Cuando está activo se mueve a su posición 0 */
        .sidebar.active {
            right: 0;
        }

        /* --- SIDEBAR HEADER (Encabezado del Menú Lateral) --- */
        .sidebar-header {
            display: flex;
            justify-content: right;
            /* Empuja el logo a la izquierda y el botón a la derecha */
            align-items: center;
            /* Centra ambos elementos verticalmente */
            padding: 12px;
            background-color: var(--navbar-bg);
            /* Fondo oscuro igual al de la imagen */
            margin-bottom: 10px;
            /* border-bottom: 2px solid var(--gold-main); <- Opcional si quieres una línea dorada separadora */
        }

        .sidebar-logo {
            width: 100px;
            /* Tamaño real y visible para el logo */
            height: auto;
            position: relative;
            right: 12px;
            display: block;
            /* Eliminamos el background, relative, left y bottom para que Flexbox lo acomode */
            transition: all 0.3s ease;
        }

        .close-icon-btn {
            background: transparent;
            /* Fondo transparente en lugar de un color fijo */
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-icon-btn img {
            width: 45px;
            /* Tamaño real y proporcionado para el botón (hamburguesa o cerrar) */
            height: auto;
            /* Eliminamos los position y bottom que lo desubicaban */
            transition: width 0.3s ease;
            /* Nota: Si tu imagen original ya es dorada, puedes borrar la línea de abajo. Si es negra y necesitas que se vea dorada, déjala. */
            filter: brightness(0) invert(1) sepia(1) saturate(5) hue-rotate(5deg);
        }

        /* Enlaces del menú (Aquí está la magia del Scroll) */
        .sidebar-links {
            display: flex;
            flex-direction: column;
            padding: 0 40px;
            flex: 1;
            /* Le dice que ocupe todo el espacio restante */
            overflow-y: auto;
            /* Activa el scroll vertical si es necesario */
        }

        /* Personalización del Scrollbar para que se vea elegante */
        .sidebar-links::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-links::-webkit-scrollbar-track {
            background: #111;
        }

        .sidebar-links::-webkit-scrollbar-thumb {
            background: var(--gold-main);
            border-radius: 10px;
        }

        .sidebar-links a {
            text-decoration: none;
            font-size: 20px;
            color: white;
            padding: 15px 0;
            border-bottom: 1px solid #222;
            transition: all 0.3s ease;
            flex-shrink: 0;
            /* Evita que los enlaces se aplasten */
        }

        .sidebar-links a:hover {
            color: var(--gold-main);
            padding: 15px 15px;
        }

        /* Botón Cerrar (Fijo al final) */
        .sidebar-footer {
            margin-top: auto;
            padding: 20px 40px 40px 40px;
            /* Ajuste del padding para que no se vea apretado con el scroll */
            display: flex;
            justify-content: center;
        }

        .cerrar-sesion,
        .btn-cerrar-sesion {
            background: #D09E10;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 0;
            width: 100%;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-cerrar-sesion {
            background: none;
        }

        .cerrar-sesion:hover {
            background-color: #8b0000;
            transform: scale(1.02);
        }

        /* --- OVERLAY CON BLUR --- */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(9, 9, 9, 0.304);
            backdrop-filter: blur(2px);
            z-index: 1500;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .linea-1 {
            position: relative;
            top: -12px;
            height: 2px;
            background: #D09E10;
            margin-bottom: 22px;
        }

        /* ========================================= */
        /* --- MEDIA QUERIES PARA RESPONSIVIDAD --- */
        /* ========================================= */
        /* Tablets y pantallas medianas (hasta 768px) */
        @media screen and (max-width: 768px) {
            :root {
                --navbar-height: 70px;
                --icon-size: 45px;
                --padding-sides: 15px;
            }

            .navbar-logo img {
                height: 50px;
            }

            .sidebar-logo {
                right: 15px;
                width: 120px;
            }

            .close-icon-btn img {
                width: 50px;
            }
        }

        /* Teléfonos móviles (hasta 480px) */
        @media screen and (max-width: 480px) {
            :root {
                --navbar-height: 60px;
                --icon-size: 35px;
                --padding-sides: 10px;
            }

            .navbar-group {
                gap: 10px;
            }

            .navbar-logo img {
                height: 40px;
            }

            .sidebar {
                width: 100%;
                max-width: 320px;
            }

            .sidebar-header {
                padding: 15px 20px;
            }

            .sidebar-logo {
                left: 10px;
                width: 100px;
            }

            .close-icon-btn img {
                width: 40px;
            }

            .sidebar-links {
                padding: 0 20px;
            }

            .sidebar-links a {
                font-size: 18px;
                padding: 12px 0;
            }

            .sidebar-footer {
                padding: 15px 20px 25px 20px;
                /* Reducido para móviles */
            }

            .cerrar-sesion,
            .btn-cerrar-sesion {
                font-size: 18px;
                padding: 10px 0;
            }
        }
    </style>
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
        <div class="linea-1"></div>

        <nav class="sidebar-links">
            <a href="/streepsoft/dashboard">Estadísticas</a>
            <a href="/streepsoft/jugadores/gestion">Gestión de alumnos</a>
            <a href="/streepsoft/jugadores/deudas">Deudas</a>
            <a href="/streepsoft/perfil-jugador">Perfil de alumnos</a>
            <a href="#">Actualización de datos</a>
            <a href="#">Registro de deuda</a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="/streepsoft/logout" class="cerrar-sesion" onsubmit="return confirm('¿Realmente deseas cerrar sesión?');">
                <input type="hidden" name="_token" value="<?php echo htmlspecialchars($csrfToken ?? ''); ?>">
                <button type="submit" class="btn-cerrar-sesion">Cerrar sesión</button>
            </form>
        </div>
    </div>

    <div id="overlay" class="overlay" onclick="toggleMenu()"></div>

    <script src="/streepsoft/public/js/dashboard/hamburguesa.js"></script>
</body>

</html>