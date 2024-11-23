<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir conexión
require_once '../conexion/conexion.php';

// Crear instancia de conexión
$conexion = new Conexion();
$db = $conexion->conectar();
$baseDatosConectada = false;

// Verificar si la conexión es exitosa
if ($db) {
    $baseDatosConectada = true;
}

// Inicializar mensaje para mostrar después de intentar registrar
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])) {
    // Recoger los datos del formulario
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $correo = $_POST['Correo'];
    $usuario = $_POST['Usuario'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptar contraseña

    if ($baseDatosConectada) {
        try {
            // Preparar la consulta SQL
            $query = "INSERT INTO administrador (Nombre, Apellido, correo, Usuario, Contraseña) 
                      VALUES (:nombre, :apellido, :correo, :usuario, :password)";
            $stmt = $db->prepare($query);

            // Asignar valores a los parámetros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':password', $password);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $mensaje = "Usuario registrado exitosamente.";
            } else {
                $mensaje = "Error al registrar el usuario.";
            }
        } catch (PDOException $e) {
            $mensaje = "Error en la base de datos: " . $e->getMessage();
        }
    } else {
        $mensaje = "No se pudo conectar a la base de datos.";
    }
}
?>
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
        <!-- Mostrar el estado de la conexión -->
        <?php if ($baseDatosConectada): ?>
            <div class="alert alert-success">
                Conexión exitosa a la base de datos.
            </div>
        <?php else: ?>
            <div class="alert alert-error">
                No se pudo conectar a la base de datos.
            </div>
        <?php endif; ?>

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

        <!-- Mostrar mensaje de éxito o error -->
        <?php if (!empty($mensaje)): ?>
            <div class="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
