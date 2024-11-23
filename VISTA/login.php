<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../conexion/conexion.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    // Recoger los datos del formulario
    $usuario = $_POST['Usuario'];
    $password = $_POST['password'];
    $rol = $_POST['role'];  // El rol seleccionado (debería ser 'admin' para administrador)

    // Verificar que el rol sea 'admin'
    if ($rol != 'admin') {
        $mensaje = "Rol inválido.";
    } else {
        // Crear una instancia de conexión
        $conexion = new Conexion();
        $db = $conexion->conectar();
        $baseDatosConectada = false;

        // Verificar si la conexión es exitosa
        if ($db) {
            $baseDatosConectada = true;
        }

        // Si la conexión es exitosa, comprobar las credenciales
        if ($baseDatosConectada) {
            try {
                // Consultar la tabla administrador para verificar el usuario
                $query = "SELECT * FROM administrador WHERE Usuario = :usuario";

                $stmt = $db->prepare($query);
                $stmt->bindParam(':usuario', $usuario);
                $stmt->execute();

                // Comprobar si se encuentra el usuario
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user && password_verify($password, $user['Contraseña'])) {
                    // Si la contraseña es correcta, redirigir al dashboard del administrador
                    header('Location: admin_dashboard.php');  // Redirigir al dashboard del admin
                    exit();
                } else {
                    $mensaje = "Usuario o contraseña incorrectos.";
                }
            } catch (PDOException $e) {
                $mensaje = "Error en la base de datos: " . $e->getMessage();
            }
        } else {
            $mensaje = "No se pudo conectar a la base de datos.";
        }
    }
}
?>

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
            <form method="POST" action="login.php">
                <div class="input-group">
                    <i class="fas fa-users"></i>
                    <select id="role" name="role" required>
                        <option value="">Seleccione un rol...</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="Usuario" id="username" placeholder="Usuario" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-key"></i>
                    <input type="password" name="password" id="password" placeholder="Contraseña" required>
                    <i class="fas fa-eye-slash" id="togglePassword"></i>
                </div>
                <a href="OlvidasteContraseña.php" class="forgot-password">¿Olvidaste tu contraseña?</a>
                <button type="submit" name="login" class="login-button"><b>Iniciar sesión</b></button>
                <p id="error-message" style="color: red;"><?php echo $mensaje; ?></p>
            </form>
            <p class="register">¿Aún no tienes cuenta? <a href="crearcuenta.php">Únete aquí</a></p>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
    </script>
</body>
</html>
