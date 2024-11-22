<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/styles_crearcuenta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Crear cuenta nueva</title>
</head>

<body>
    <div class="contenedor">
        <div class="box">
            <div class="encabezado">
                <h2>Crear una cuenta nueva</h2>
                <h5>¿Ya te registraste? <a href="login.php" class="login-link">Inicia sesión aquí</a></h5>
            </div>

            <form method="post" action="crearcuenta.php">
                <div class="input-group">
                    <h4>Nombre</h4>
                    <input type="text" name="Nombre" placeholder="Jimena" required>
                    <h4>Apellido</h4>
                    <input type="text" name="Apellido" placeholder="Jimenez" required>
                    <h4>Correo</h4>
                    <input type="email" name="Correo" placeholder="Ejemplo@gmail.com" required>
                    <h4>Usuario</h4>
                    <input type="text" name="Usuario" placeholder="jimena123" required>
                    <h4>Contraseña</h4>
                    <input type="password" name="password" placeholder="*****" required>
                </div>

                <button type="submit" name="registrar" class="Registrarse">Registrarse</button>
            </form>

            <?php if (isset($mensaje)): ?>
                <div class="alert">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>