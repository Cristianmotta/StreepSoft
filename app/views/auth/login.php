<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Font Awesome - librería de íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="/streepsoft/public/css/login.css">
   <link rel="stylesheet" href="/streepsoft/public/css/login-alert.css">
</head>

<body class="background-login">
    <div class="page-wrapper">
        <div class="login-card">

            <div class="link-password">
                <a href="/streepsoft/public/"><img src="/streepsoft/public/Image/icon_arrow_back.svg" alt=""></a>
            </div>

            <img src="/streepsoft/public/Image/CopColombiaInternacional.svg" alt="Logo" class="logoLogin" draggable="false">

            <h1 class="h1-login">Iniciar Sesión</h1>

            <form action="/streepsoft/app/controllers/loginController.php"  method="POST">

                <div class="input-group">
                    <label for="email">Correo</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" id="email" name="usuario" placeholder="Usuario" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="contrasena" placeholder="Contraseña" required>
                    </div>
                </div>

                <?php if(isset($_GET['error'])): ?>
                    <div id="mensajeError" class="alert-login-error">
                        <p class="parrafo">Contreseña Usuario o Incorrecta</p>
                        <div class="barra-tiempo"></div>
                    </div>
                <?php endif; ?>
                    
                <button class="buttonLogin" type="submit">Iniciar Sesión</button>

                <div class="link">
                    <div class="link-password">
                        <a class="alogin" href="/streepsoft/app/views/auth/logincorreo.php">¿Olvidaste tu contraseña?</a>
                    </div>

                </div>
                
            </form>
        </div>
    </div>

    <script src="/streepsoft/public/js/login/login.js"></script>
</body>

</html>