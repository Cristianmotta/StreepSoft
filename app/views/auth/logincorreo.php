<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/streepsoft/public/css/login.css">
</head>
<body>
    <div class="background-login">
        <div class="login-card">
            <form action="/streepsoft/app/controllers/RecuperacionController.php" method="POST">
                
                <img src="/streepsoft/public/Image/CopColombiaInternacional.png" alt="Logo" class="logoLogin" draggable="false">

                <h1 class="h1-recover">Escriba su correo por favor</h1>
                
                <p class="message-code">Le enviaremos un código de verificación para restablecer su contraseña.</p>

                <div class="input-group">
                    <label for="usuario">Email</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" 
                               id="usuario"
                               name="usuario" 
                               placeholder="correo@ejemplo.com"
                               required>
                    </div>
                </div>

                <button class="buttonRecover" type="submit" name="enviar_correo">Enviar</button>
                
                <div class="link">
                    <a href="/streepsoft/app/views/auth/login.php">Volver al Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>