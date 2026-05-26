<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Codigo</title>
    <link rel="stylesheet" href="/streepsoft/public/css/login.css">
</head>
<body class="background-login">
    <div class="page-wrapper">
        <div class="login-card">

            <img src="/streepsoft/public/Image/CopColombiaInternacional.svg" alt="logo-recover" class="logo-recover"
                draggable="false">

            <h1 class="h1-verify">Pin de Seguridad</h1>

            <form action="/streepsoft/app/controllers/RecuperacionController.php" method="POST" id="pinForm">
                
                <div class="pin-container">
                    <input class="pin-input" type="text" maxlength="1" name="pin[]" inputmode="numeric" pattern="[0-9]*" required>
                    <input class="pin-input" type="text" maxlength="1" name="pin[]" inputmode="numeric" pattern="[0-9]*" required>
                    <input class="pin-input" type="text" maxlength="1" name="pin[]" inputmode="numeric" pattern="[0-9]*" required>
                    <input class="pin-input" type="text" maxlength="1" name="pin[]" inputmode="numeric" pattern="[0-9]*" required>
                    <input class="pin-input" type="text" maxlength="1" name="pin[]" inputmode="numeric" pattern="[0-9]*" required>
                </div>

                <input type="hidden" name="usuario" value="<?=  $_GET['usuario'] ?? ''  ?>">

                <button class="buttonRecover" type="submit" name="verificar_pin">Verificar</button>
            </form>
            
            <a href="/streepsoft/app/views/auth/logincorreo.php">volver</a>

        </div>
    </div>

    <script src="/streepsoft/public/js/login/verify.js"></script>
</body>
</html>