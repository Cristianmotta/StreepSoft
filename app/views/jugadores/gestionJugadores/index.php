<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Alumnos</title>
    <link rel="stylesheet" href="/streepsoft/public/css/jugadores/gestion.css" />
</head>
<body>
    <div id="nav-card"></div>

    <div class="button-group">
        <a href="../gestionJugadores/index.php" class="activo">Registro</a>
        <a href="../deudasJugadores/index.php" >Deudas Alumnos</a>
        <span></span>
   </div>


    <div class="card-border">
        <div class="black-card">
            <div class="text-card">
                <h1>Gestion de Alumno</h1>
                <p>Temporada 2026 -<span> Registrados 5 Alumnos </span></p>
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
                    <button>
                        <img src="/streepsoft/public/Image/search.png" alt="search">
                    </button>

                    <input type="text" placeholder="Buscar Alumno">
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
                        <tr>
                            <td>
                                <div class="table-foto">
                                    J
                                </div>
                            </td>
                            <td>Castillo moreno</td>
                            <td>Juan luis</td>
                            <td>12/06/2004</td>
                            <td>22</td>
                            <td>sub 20</td>
                            <td>Mcj</td>
                            <td>Luis</td>
                            <td>Juan torres</td>
                            <td>312-566-8893</td>
                            <td>
                                <div class="table-estado">
                                    <p>activo</p>
                                </div>
                            </td>
                            <td>29/01/2026</td>
                            <td>
                                <div class="pago">
                                    <p>pago</p>
                                </div>
                            </td>
                            <td>
                                <div class="acciones">
                                    <button>
                                        <span class="mingcute--edit-fill"></span>
                                    </button>
                                    <button>
                                        <span class="ic--round-delete"></span>                                                                                                                         
                                    </button>
                                </div>
                            </td>
                        </tr>
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

   <script src="/streepsoft/public/js/jugadores/gestion.js"></script>
   <script src="/streepsoft/public/js/dashboard/hamburguesa.js"></script>
   <script type="module" src="/streepsoft/public/js/nav/export.js"></script>
</body>
</html>