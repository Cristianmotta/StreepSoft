<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Alumnos</title>
    <link rel="stylesheet" href="/streepsoft/public/css/jugadores/gestion.css" />
    <link rel="icon" type="image/png" href="/streepsoft/public/Image/logo.jpeg">
    <style>
        .estado-activo {  
            color: #28a745; 
            font-weight: bold; 
        }

        .estado-inactivo { 
            color: #dc3545; 
            font-weight: bold; 
        }

        .pago-pagado {
            background-color: #28a745;   /* verde */
            color: white;
            padding: 0 0 12px;
            border-radius: 5px;
        }

        .pago-pendiente {
            background-color: #ffc107;   /* amarillo */
            color: #1f1f1f;
            padding: 0 0 12px;
            border-radius: 5px;
        }

        .pago-mora {
            background-color: #dc3545;   /* rojo */
            color: white;
            padding: 0 0 12px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div id="nav-card"></div>

    <div class="button-group">
        <a href="/streepsoft/jugadores/gestion" class="activo">Registro</a>
        <a href="/streepsoft/jugadores/deudas" >Deudas Alumnos</a>
        <span></span>
   </div>

    <div class="card-border">
        <div class="black-card">
            <div class="text-card">
                <h1>Gestion de Alumno</h1>
                <p>Temporada 2026 -<span> Registrados <?= count ($jugadores) ?> Alumnos </span></p>
            </div>


            <div class="botton-card">
                <div class="botton-alumno">
                    <a href="../Nuevo Alumnos/alumno.html">+ Nuevo alumno</a>
                </div>
            </div>
        </div>

        <div class="card-options">
            <div class="card-select">
                <div class="select-categorias">
                    <label class="categoria">Categorias</label>
                    <select class="custom-select" placeholder="categorias">
                        <button>
                            <selectedcontent></selectedcontent>
                        </button>
                    <option value="todos">Todos</option>
                    <optgroup label="Infantil">
                        <option value="sub-10">sub 6 </option>
                        <option value="sub-10">sub 10</option>
                    </optgroup>


                    <optgroup label="Juvenil">
                        <option value="sub-13">sub 13</option>
                        <option value="sub-15">sub 15</option>
                        <option value="sub-17">sub 17</option>
                        <option value="sub-20">sub 20</option>
                    </optgroup>
                </select>
                </div>
            </div>

            <div class="card-select">
                <div class="select-estado">
                    <label class="estado">Estado</label>
                    <select class="custom-select">
                        <button>
                            <selectedcontent></selectedcontent>
                        </button>
                    <option value="todo">Todos</option>
                    <option value="">Activo</option>
                    <option value="">Inactivo</option>
                </select>
                </div>
            </div>

            <div class="card-buscar">
                <div class="buscar">
                    <button type="button" id="btnLimpiarBusqueda" title="Limpiar búsqueda">
                        <img src="/streepsoft/public/Image/search.png" alt="search">
                    </button>

                    <input type="text" id="buscarInput" placeholder="Buscar Alumno" autocomplete="off">
                </div>
            </div>

        </div>

        <div class="division"></div>

        <div class="card-table">
            <div class="table-responive">
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>Fecha Nacimiento</th>
                            <th>Edad</th>
                            <th>Categoria</th>
                            <th>Inicial</th>
                            <th>Instructor</th>
                            <th>Acudiente</th>
                            <th>Numero Acudiente</th>
                            <th>Estado</th>
                            <th>Fecha limite</th>
                            <th>Pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jugadores as $jugador): ?>
                        <tr>
                            <td>
                                <div class="table-foto">
                                    J
                                </div>
                            </td>
                            <td><?= htmlspecialchars($jugador['apellidos']) ?></td>
                            <td><?= htmlspecialchars($jugador['nombres'])  ?></td>
                            <td><?= htmlspecialchars($jugador['fecha_nacimiento']) ?></td>
                            <td><?= htmlspecialchars($jugador['edad']) ?></td>
                            <td><?= htmlspecialchars($jugador['categoria']) ?></td>
                            <td><?= htmlspecialchars($jugador['iniciales']) ?></td>
                            <td><?= htmlspecialchars($jugador['instructor']) ?></td>
                            <td><?= htmlspecialchars($jugador['acudiente']) ?></td>
                            <td><?= htmlspecialchars($jugador['numero_acudiente']) ?></td>
                            <td>
                                <div class="estado estado-<?= strtolower($jugador['estado']) ?>">
                                    <p><?= htmlspecialchars($jugador['estado']) ?></p>
                                </div>  
                            </td>
                            <td><?= htmlspecialchars($jugador['fecha_limite_pago']) ?></td>
                            <td>
                                <div class="pago pago-<?= strtolower($jugador['pago']) ?>">
                                    <p><?= htmlspecialchars($jugador['pago']) ?></p>
                                </div>
                            </td>
                            <td>
                                <div class="acciones">
                                    <button>
                                        <span class="mingcute--edit-fill"></span>
                                    </button>
                                    <form method="post" action="gestionJugadores.php?action=eliminar" style="display:inline;" onsubmit="return confirm('¿Eliminar este jugador?')">
                                        <input type="hidden" name="id_jugadores" value="<?= $jugador['id_jugadores'] ?>">
                                        <button type="submit" class="btn-eliminar">
                                            <span class="ic--round-delete"></span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="division-2"></div>

        <div class="card-footer">
            <div class="pagination">
                <button class="page-btn">❮</button>
                
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">❯</button>
            </div>
        </div>
    </div>    

   <script>
        document.addEventListener('DOMContentLoaded', function() {
        const inputBuscar = document.getElementById('buscarInput');
        const filas = document.querySelectorAll('.tabla tbody tr');
        const btnLimpiar = document.getElementById('btnLimpiarBusqueda');

            function filtrarTabla() {
                const texto = inputBuscar.value.toLowerCase().trim();
                
                filas.forEach(fila => {
                    // Obtener todo el texto de la fila
                    const textoFila = fila.textContent.toLowerCase();
                    // Si el texto buscado está contenido, se muestra; si no, se oculta
                    fila.style.display = textoFila.includes(texto) ? '' : 'none';
                });
            }

            // Al escribir
            inputBuscar.addEventListener('input', filtrarTabla);

            // Botón para limpiar el campo
            btnLimpiar.addEventListener('click', function() {
                inputBuscar.value = '';
                filtrarTabla();  // Actualizar la vista (mostrar todo)
            });
        });
   </script>
   <script src="/streepsoft/public/js/jugadores/gestion.js"></script>
   <script src="/streepsoft/public/js/dashboard/hamburguesa.js"></script>
   <script type="module" src="/streepsoft/public/js/nav/export.js"></script>
</body>
</html>
