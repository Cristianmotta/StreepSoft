<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrar Nueva Deuda</title>
    <link rel="stylesheet" href="/streepsoft/public/css/deuda/deuda.css" />
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
            <a href="">Estadísticas</a>
            <a href="#">Gestión de alumnos</a>
            <a href="#">Perfil de alumnos</a>
            <a href="#">Actualización de datos</a>
            <a href="#">Registro de deuda</a>
        </nav>
        <div class="sidebar-footer">
            <button class="btn-cerrar-sesion" onclick="toggleMenu()">Cerrar</button>
        </div>
    </div>

    <div id="overlay" class="overlay" onclick="toggleMenu()"></div>

    <div class="container">
        <div class="header">
            <h1>Registrar Nueva Deuda</h1>
            <div class="top-bar">
                <select id="tipoSelect">
                    <option value="Becado">Becado</option>
                    <option value="Regular">Regular</option>
                    <option value="Externo">Externo</option>
                </select>
                <input type="search" id="searchAlumno" placeholder="Buscar alumno" />
            </div>
        </div>

        <div class="card-grid">
            <div class="panel">
                <div class="field-grid">
                    <div class="field">
                        <label for="nombreCompleto">Nombre completo</label>
                        <input type="text" id="nombreCompleto" value="Juan Pablo Lesmes Mora" />
                    </div>
                    <div class="field photo-box">
                        <img id="fotoAlumno"
                            src="imagen/jp.jpg"
                            alt="Foto del alumno" />
                    </div>
                    <div class="field">
                        <label for="fechaDeuda">Fecha</label>
                        <input type="date" id="fechaDeuda" value="2026-04-12" />
                    </div>
                    <div class="field">
                        <label for="montoDeuda">Deuda</label>
                        <input type="number" id="montoDeuda" value="2000.00" step="0.01" min="0" />
                    </div>
                </div>

                <button class="assign-btn" id="assignBtn">Asignar Deuda</button>
                <p class="footer-note">Puedes cambiar el nombre, fecha, tipo y valor de la deuda. Los datos se reflejan
                    directamente en el resumen a la derecha.</p>
            </div>

            <div class="summary-card">
                <div class="summary-item">
                    <div>
                        <strong>ID</strong>
                    </div>
                    <span id="summaryId">2</span>
                </div>
                <div class="summary-item">
                    <div><strong>Nombre</strong></div>
                    <span id="summaryNombre">Juan Pablo Lesmes Mora</span>
                </div>
                <div class="summary-item">
                    <div><strong>Fecha</strong></div>
                    <span id="summaryFecha">12/04/26</span>
                </div>
                <div class="summary-item">
                    <div><strong>Tipo</strong></div>
                    <span id="summaryTipo">Becado</span>
                </div>
                <div class="summary-item">
                    <div><strong>Actividad</strong></div>
                    <span id="summaryActividad">activo</span>
                </div>

                <div class="summary-total">
                    <div class="symbol">$</div>
                    <div class="amount" id="summaryMonto">20.000</div>
                </div>
            </div>
        </div>
    </div>

    <script src="/streepsoft/public/js/deuda.js"></script>
    <script src="/streepsoft/public/js/dashboard/hamburguesa.js"></script>
</body>

</html>