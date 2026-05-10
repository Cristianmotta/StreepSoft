<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Font Awesome - librería de íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/streepsoft/public/css/login.css">
</head>
<body>
    <div class="page-wrapper">
        <div class="login-card">

            <img src="/streepsoft/public/Image/CopColombiaInternacional.svg" alt="Logo" class="logo">

            <h1>Login Up</h1>

            <form action="#"  method="_POST">

                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-user"></i>
                        <input type="email" id="email">
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password">
                    </div>
                </div>

                <button type="submit">Login Now</button> <!-- redirecionar a la carpeta dashboard/index.php --->

                <div class="link">
                    <div class="link-password">
                        <a href="#">Forget password?</a>
                    </div>

                    <div class="link-password">
                        <a href="/streepsoft/public/"><img src="/streepsoft/public/Image/icon_arrow_back.svg" alt=""></a>
                    </div>
                </div>
               
                

            </form>
        </div>
    </div>
    <script src="/streepsoft/public/js/login.js"></script>
</body>

</html>