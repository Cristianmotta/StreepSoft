<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadistica | Streepssoft</title>
    <link rel="stylesheet" href="/streepsoft/public/css/dashboard/dashboard.css">
</head>
<body>
    
    <div id="nav-card"></div>

    <section class="sec-statistics">
        <h1 class="h1-statistics">Estadistica</h1>

        <div class="card-statistics">
            <!-- Contenedor para alinear el select a la derecha -->
            <div class="chart-header">
                <div class="select-wrapper">
                    <label for="year-select">año</label>
                    <select class="custom-select">
                        <button> 
                            <selectedcontent></selectedcontent>
                        </button>
                        <option value="2026"> 2026</option>
                        <option value="2025"> 2025 </option>
                    </select>
                </div>
            </div>
            
            <div class="chart-container">
                <canvas id="grafica"></canvas>
            </div>
        </div>
    </section>


    <div class="dashboard-container">
        <div class="dashboard-grid">
            <a href="#" class="custom-card">
                <div class="card-icon">
                    <img src="/streepsoft/public/Image/Gestion.png" alt="icon">
                </div>
                <div class="card-body">
                    <h2 class="card-title">Gestion de alumnos</h2>
                    <div class="card-divider"></div>
                    <p class="card-subtitle">Ver alumnos</p>
                </div>
            </a>

            <a href="#" class="custom-card">
                <div class="card-icon">
                    <img src="/streepsoft/public/Image/users.png" alt="icon">
                </div>
                <div class="card-body">
                    <h2 class="card-title">Perfil de Alumno</h2>
                    <div class="card-divider"></div>
                    <p class="card-subtitle">Ver alumnos</p>
                </div>
            </a>

            <a href="#" class="custom-card">
                <div class="card-icon">
                    <img src="/streepsoft/public/Image/actualizacion.png" alt="icon">
                </div>
                <div class="card-body">
                    <h2 class="card-title">Actualizacion de datos</h2>
                    <div class="card-divider"></div>
                    <p class="card-subtitle">Ver alumnos</p>
                </div>
            </a>
        </div>
    </div>
    
    <script src="/streepsoft/public/js/dashboard/hamburguesa.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/streepsoft/public/js/dashboard/statistic.js"></script>
    <script type="module" src="/streepsoft/public/js/nav/export.js"></script>
    <script src="/streepsoft/public/js/timer/time.js"></script>
    <script>
        // ✅ BLOQUEAR RETROCESO EN DASHBOARD
        
        // Detener cualquier intento de navegación hacia atrás
        window.history.pushState(null, null, window.location.href);
        
        window.addEventListener('popstate', function(event) {
            // Bloquear silenciosamente
            window.history.pushState(null, null, window.location.href);
        });
</script>
</body>
</html>