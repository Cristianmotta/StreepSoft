<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Alumnos</title>
    <link rel="stylesheet" href="/streepsoft/public/css/jugadores/deudas.css" />
</head>
<body>
    <div id="nav-card"></div>

    <div class="button-group">
        <a href="../gestionJugadores/index.php" >Registro</a>
        <a href="../deudasJugadores/index.php" class="activo">Deudas Alumnos</a>
        <span></span>
   </div>

    <div class="card-border">

        <div class="black-card">
            <div class="text-card">
                <h1>Deudas Alumno</h1>
                <p>Actualmente exiten <span> 2 deudas</span></p>
            </div>


            <div class="botton-card">
                <div class="botton-alumno">
                    <a href="#">+ Registrar Nueva deuda</a>
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
                <div class="select-año">
                    <label class="año">Año</label>
                    <select class="custom-select">
                        <button>
                            <selectedcontent></selectedcontent>
                        </button>
                        <option value="todo">Todos</option>
                        <option value="">2026</option>
                        <option value="">2025</option>
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
                        <option value="">Mora</option>
                        <option value="">Pago</option>
                    </select>
                </div>
            </div>

            <div class="card-select">
                <div class="select-tipo">
                    <label class="tipo">Tipo</label>
                    <select class="custom-select">
                        <button>
                            <selectedcontent></selectedcontent>
                        </button>
                        <option value="todo">Todos</option>
                        <option value="">Beca</option>
                        <option value="">Media-beca</option>
                        <option value="">Normal</option>
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
                            <th><h3>Nombres y apellidos</h3></th>
                            <th>Tipo</th>
                            <th>
                                <div class="table-column">
                                    <h3>Matricula</h3>
                                    <p>Fecha pago</p>
                                </div>
                            </th>
                            <th>
                                <div class="table-column">
                                    <h3>Ene</h3>
                                    <p>Fecha pago</p>
                                </div>
                            </th>
                            <th>
                                <div class="table-column">
                                    <h3>Feb</h3>
                                    <p>Fecha pago</p>
                                </div>
                            </th>
                            <th>
                                <div class="table-column">
                                    <h3>Mar</h3>
                                    <p>Fecha pago</p>
                                </div>
                            </th>
                            <th>
                                <div class="table-column">
                                    <h3>Abr</h3>
                                    <p>Fecha pago</p>
                                </div>
                            </th>
                            <th>
                                <div class="table-column">
                                    <h3>May</h3>
                                    <p>Fecha pago</p>
                                </div>
                            </th>
                            <th>
                                <div class="table-column">
                                    <h3>Jun</h3>
                                    <p>Fecha pago</p>
                                </div>
                            </th>
                            <th>
                                <div class="table-column">
                                    <h3>Jul</h3>
                                    <p>Fecha pago</p>
                                </div>
                            </th>
                            <th>
                                <div class="table-column">
                                    <h3>Ago</h3>
                                    <p>Fecha pago</p>
                                </div>
                            </th>
                            <th>
                                <div class="table-column">
                                    <h3>Sep</h3>
                                    <p>Fecha pago</p>
                                </div>
                            </th>
                            <th>
                                <div class="table-column">
                                    <h3>Oct</h3>
                                    <p>Fecha pago</p>
                                </div>
                            </th>
                            <th>
                                <div class="table-column">
                                    <h3>Nov</h3>
                                    <p>Fecha pago</p>
                                </div>
                            </th>
                            <th>
                                <div class="table-column">
                                    <h3>Dic</h3>
                                    <p>Fecha pago</p>
                                </div>
                            </th>
                            <th>Total</th>
                            <th>pago</th>
                            <th>Acciones</th>
                            <th>pagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="table-foto">
                                    J
                                </div>
                            </td>
                            <td>Luis blanco castillo</td>
                            <td>Normal</td>
                            <td>
                                <div class="table-column">
                                    <h4>$90.000 cop</h4>
                                    <p>12/09/2026</p>
                                </div>
                            </td>
                            <td>
                                <div class="table-column">
                                    <h5>$80.000cop</h5>
                                    <p>12/09/2026</p>
                                </div>
                            </td>
                            <td>
                                 <div class="table-column">
                                    <h5>$80.000cop</h5>
                                    <p>12/09/2026</p>
                                </div>
                            </td>
                            <td>n/a</td>
                            <td>n/a</td>
                            <td>n/a</td>
                            <td>n/a</td>
                            <td>n/a</td>
                            <td>n/a</td>
                            <td>n/a</td>
                            <td>n/a</td>
                            <td>n/a</td>
                            <td>n/a</td>
                            <td>
                                <div class="table-column">
                                    <h5>$160.000 cop</h5>
                                </div>
                            </td>
                            <td>
                                <div class="table-estado">
                                    <p>Pago</p>
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
                            <td>
                                <div class="pago">
                                    <button>
                                        <span class="hugeicons--payment-02"></span>
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