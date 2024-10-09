<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminiPark - Iniciar sesión</title>
    <link rel="stylesheet" href="styles_InicioSesion.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
            <h1>ADMINIPARK</h1>
            <div class="icon-logo"></div>
            </div>
            <h2>¡Bienvenido!</h2>
            <form>
            <div class="input-group">
                <i class="fas fa-users"></i>
                <select>
                    <option value="">Seleccione un rol...</option>
                    <option value="admin">Administrador</option>
                    <option value="user">Usuario</option>
                </select>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Usuario o correo">
            </div>
            <div class="input-group">
                <i class="fas fa-key"></i>
                <input type="password" placeholder="Contraseña">
                <i class="fas fa-eye-slash" id="togglePassword"></i>
            </div>
                <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                <button type="submit" class="login-button">Iniciar sesión</button>
            </form>
            <p class="register">¿Aún no tienes cuenta? <a href="#">Únete aquí</a></p>
        </div>
    </div>
</body>
</html>


