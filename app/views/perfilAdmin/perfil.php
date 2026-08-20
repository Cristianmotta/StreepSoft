<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Administrador | Streepsoft</title>
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <link rel="stylesheet" href="/streepsoft/public/css/perfilAdmin/perfilAdmin.css">
</head>

<body>
    <div id="nav-card"></div>

    <div class="main-content">

        <div class="perfil-admin-container">
            <div class="perfil-fila-superior">
                <div class="tarjeta-datos">
                    <button class="boton-editar-info">
                        <i class="fi fi-rr-pencil"></i> Editar información
                    </button>

                    <div class="datos-personales">
                        <div class="foto-wrapper">
                            <div class="foto-placeholder">
                                <i class="fi fi-rr-user"></i>
                            </div>
                            <button class="boton-cambiar-foto">Cambiar foto</button>
                        </div>

                        <div class="info-admin">
                            <h2>Nombre Administrador</h2>
                            <p class="rol-admin">Administrador</p>

                            <div class="dato-linea">
                                <i class="fi fi-rr-envelope"></i>
                                <div>
                                    <span class="dato-label">Correo electrónico</span>
                                    <strong>nombre.administrador@gmail.com</strong>
                                </div>
                            </div>

                            <div class="dato-linea">
                                <i class="fi fi-rr-phone-call"></i>
                                <div>
                                    <span class="dato-label">Teléfono</span>
                                    <strong>+57 300 123 4567</strong>
                                </div>
                            </div>

                            <div class="dato-linea">
                                <i class="fi fi-rr-calendar"></i>
                                <div>
                                    <span class="dato-label">Fecha de registro</span>
                                    <strong>15 de enero de 2024</strong>
                                </div>
                            </div>

                            <div class="dato-linea">
                                <i class="fi fi-rr-user"></i>
                                <div>
                                    <span class="dato-label">Nombre de Usuario</span>
                                    <strong>Usuario04</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="linea-divisora"></div>
                </div>

                <!--Actividad reciente-->
                <div class="tarjeta-actividad">
                    <h3><i class="fi fi-rr-pending"></i> Actividad Reciente</h3>

                    <div class="lista-actividad">
                        <div class="item-actividad">
                            <span class="punto-actividad"></span>
                            <p>Inicio de sesión exitoso</p>
                            <span class="fecha-actividad">Hoy, 8:45 AM</span>
                        </div>

                        <div class="item-actividad">
                            <span class="punto-actividad"></span>
                            <p>Generó reporte de pagos</p>
                            <span class="fecha-actividad">Ayer, 4:30 PM</span>
                        </div>

                        <div class="item-actividad">
                            <span class="punto-actividad"></span>
                            <p>Actualizó información de jugador</p>
                            <span class="fecha-actividad">27 May, 11:20 AM</span>
                        </div>

                        <div class="item-actividad">
                            <span class="punto-actividad"></span>
                            <p>Realizó corrección de pagos</p>
                            <span class="fecha-actividad">26 May, 5:10 PM</span>
                        </div>
                    </div>

                    <button class="boton-ver-actividad">Ver toda la actividad</button>
                    <div class="linea-divisora"></div>
                </div>
            </div>

            <!-- Estadísticas del perfil -->
            <div class="stats-perfil">
                <div class="stat-perfil">
                    <div class="stat-icono">
                        <i class="fi fi-rr-users"></i>
                    </div>
                    <div>
                        <h2>80</h2>
                        <p>Jugadores Registrados</p>
                    </div>
                </div>

                <div class="stat-perfil">
                    <div class="stat-icono">
                        <i class="fi fi-rr-triangle-warning"></i>
                    </div>
                    <div>
                        <h2>10</h2>
                        <p>Jugadores en Mora</p>
                    </div>
                </div>

                <div class="stat-perfil">
                    <div class="stat-icono">
                        <i class="fi fi-rr-document"></i>
                    </div>
                    <div>
                        <h2>320</h2>
                        <p>Pagos Registrados</p>
                    </div>
                </div>

                <div class="stat-perfil">
                    <div class="stat-icono">
                        <i class="fi fi-rr-user"></i>
                    </div>
                    <div>
                        <h2>5</h2>
                        <p>Entrenadores Activos</p>
                    </div>
                </div>
            </div>

            <!-- Documentos y Reportes -->
            <div class="panel-documentos">
                <div class="documentos-header">
                    <i class="fi fi-rr-document"></i>
                    <div>
                        <h3>Documentos y reportes</h3>
                        <p>Descarga información general del sistema en diferentes formatos</p>
                    </div>
                </div>

                <div class="tabla-documentos-wrapper">
                    <table class="tabla-documentos">
                        <thead>
                            <tr>
                                <th>Documentos</th>
                                <th>Descripción</th>
                                <th>Formato</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-documento">
                                    <i class="fi fi-rr-users"></i>
                                    Reporte General de Jugadores
                                </td>
                                <td>Lista completa de todos los jugadores registrados</td>
                                <td>
                                    <select class="select-formato">
                                        <option value="pdf" selected>PDF</option>
                                        <option value="word">WORD</option>
                                        <option value="excel">EXCEL</option>
                                    </select>
                                </td>
                                <td>
                                    <button class="boton-descargar" data-tipo="jugadores">
                                        <i class="fi fi-rr-download"></i> Descargar
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td class="col-documento">
                                    <i class="fi fi-rr-money"></i>
                                    Reporte de Pagos
                                </td>
                                <td>Historial de todos los pagos realizados</td>
                                <td>
                                    <select class="select-formato">
                                        <option value="pdf" selected>PDF</option>
                                        <option value="word">WORD</option>
                                        <option value="excel">EXCEL</option>
                                    </select>
                                </td>
                                <td>
                                    <button class="boton-descargar" data-tipo="pagos">
                                        <i class="fi fi-rr-download"></i> Descargar
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td class="col-documento">
                                    <i class="fi fi-rr-triangle-warning"></i>
                                    Reporte de Deudas
                                </td>
                                <td>Estado actual de deudas de los jugadores</td>
                                <td>
                                    <select class="select-formato">
                                        <option value="pdf" selected>PDF</option>
                                        <option value="word">WORD</option>
                                        <option value="excel">EXCEL</option>
                                    </select>
                                </td>
                                <td>
                                    <button class="boton-descargar" data-tipo="deudas">
                                        <i class="fi fi-rr-download"></i> Descargar
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td class="col-documento">
                                    <i class="fi fi-rr-trophy"></i>
                                    Reporte de Torneos
                                </td>
                                <td>Historial y resultados de torneos</td>
                                <td>
                                    <select class="select-formato">
                                        <option value="pdf" selected>PDF</option>
                                        <option value="word">WORD</option>
                                        <option value="excel">EXCEL</option>
                                    </select>
                                </td>
                                <td>
                                    <button class="boton-descargar" data-tipo="torneos">
                                        <i class="fi fi-rr-download"></i> Descargar
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <button class="boton-ver-reportes">
                    <i class="fi fi-rr-folder"></i> Ver todos los reportes
                </button>
                <div class="linea-divisora"></div>
            </div>

        </div>




        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="/streepsoft/public/js/navbar/script.js"></script>
        <script type="module" src="/streepsoft/public/js/nav/export.js"></script>
        <script src="/streepsoft/public/js/perfilAdmin/perfilAdmin.js"></script>

        <-- Chatbot--
            <script src="https://cdn.botpress.cloud/webchat/v3.7/inject.js"></script>
            <script src="https://files.bpcontent.cloud/2026/05/14/19/20260514195634-UH0HGKBC.js" defer></script>
</body>

</html>