<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminiPark - Iniciar sesión</title>
    <link rel="stylesheet" href="../estilos/styles_InicioSesion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <h1>ADMINIPARK</h1>
                <div class="icon-logo">
                    <img src="../imagenes/logo.png" alt="fondo">
                </div>
            </div>
            <h2>¡Bienvenido!</h2>
            <form action="iniciar_sesion.php" method="post">
                <div class="input-group">
                    <i class="fas fa-users"></i>
                    <select name="role" required>
                        <option value="">Seleccione un rol...</option>
                        <option value="admin">Administrador</option>
                        <option value="employee">Empleado</option>
                    </select>
                </div>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Usuario o correo" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-key"></i>
                    <input type="password" name="password" placeholder="Contraseña" required>
                    <i class="fas fa-eye-slash" id="togglePassword"></i>
                </div>
                <a href="OlvidasteContraseña.php" class="forgot-password">¿Olvidaste tu contraseña?</a>
                <button type="submit" class="login-button"><b>Iniciar sesión</b></button>
            </form>
            <p class="register">¿Aún no tienes cuenta? <a href="crearcuenta.php">Únete aquí</a></p>
        </div>
    </div>

    <script>
        // Script para mostrar/ocultar la contraseña
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.querySelector('[name="password"]');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
    </script>
</body>
</html>
