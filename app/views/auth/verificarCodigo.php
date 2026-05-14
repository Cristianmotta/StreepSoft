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

            <div class="pin-container">
                <input class="pin-input" type="text" maxlength="1">
                <input class="pin-input" type="text" maxlength="1" disabled>
                <input class="pin-input" type="text" maxlength="1" disabled>
                <input class="pin-input" type="text" maxlength="1" disabled>
                <input class="pin-input" type="text" maxlength="1" disabled>
            </div>


            <button class="buttonRecover" type="button">Verificar</button>

        </div>
    </div>

    <script src="/streepsoft/public/js/login/loginverify.js"></script>
</body>
</html>