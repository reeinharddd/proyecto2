<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario CSS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/normalize.css">
    <link rel="stylesheet" href="../CSS/inicioSesion.css">
</head>

<body>
    <div class="contenedor-formulario contenedor">
        <div class="imagen-formulario">

        </div>
        <form method="post" action="../App/login.php" class="formulario">
            <div class="texto-formulario">
                <h2>Bienvenido de nuevo!</h2>
                <p>Inicia sesión con tu cuenta</p>
            </div>
            <div class="input">
                <label for="usuario">Usuario</label>
                <input placeholder="Ingrese su Usuario"  type="text" id="usuario" name="txtUser" maxlength="20" minlength="2" required>
            </div>
            <div class="input">
                <label for="contraseña">Contraseña</label>
                <input placeholder="Ingrese su contraseña" type="password" id="contraseña" name="txtPassword" maxlength="20" minlength="2" required>
            </div>          
            <!--<div class="password-olvidada">
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>-->
            <div class="input">
                <input type="submit" value="Iniciar Sesión">
            </div>
        </form>
    </div>
</body>

</head>