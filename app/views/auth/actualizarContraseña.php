<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar contraseña</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/streepsoft/public/css/login.css">
</head>
<body class="background-login">
    <div class="page-wrapper">
        <div class="login-card">

            <img src="/streepsoft/public/Image/CopColombiaInternacional.svg" alt="Logo" class="logo-recover" draggable="false">

            <h1 class="h1-Password-recovered">Contraseña recuperada</h1>

            <div class="input-group">
                <label>Nueva contraseña</label>
                <div class="input-wrapper">
                    <input type="password" id="nuevaPassword" placeholder="Nueva contraseña">
                </div>
                <div class="password-strength">
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthFill"></div>
                    </div>
                    <span class="strength-text" id="strengthText"></span>
                </div>
                <p class="req-msg" id="reqMsg"></p>
            </div>

            <div class="input-group">
                <label>Confirmar contraseña</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="confirmarPassword" placeholder="Confirmar contraseña">
                </div>
                <p class="match-msg" id="matchMsg"></p>
            </div>

            <button class="buttonLogin" type="button" id="btnActualizar">Actualizar</button>

        </div>
    </div>

    <script src="/streepsoft/public/js/login/loginupdate.js"></script>
</body>

</html>
