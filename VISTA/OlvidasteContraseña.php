<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/styles_OlvidasteContraseña.css">

    <title>Olvidaste Contraseña</title>
</head>

<body>
    <div class="contenedor">
        <div class="box">
            <div class="encabezado">
                <h2>¿Olvidaste tu contraseña?</h2>
                <h5>Recupera tu cuenta</h5>
            </div>

            <form method="POST" action="recover_password.php">
                <div>
                    <h4>Correo electrónico</h4>
                    <input type="email" name="correo" placeholder="Ejemplo@gmail.com" required>
                </div>
                <button type="submit" class="envia">Enviar</button>
            </form>
        </div>

    </div>

</body>

</html>