<?php
// Incluir la conexión a la base de datos
include '../conexionBD/conexionBD.php';
session_start();

// Verificar si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Preparar la consulta SQL para buscar el usuario
    $sql = "SELECT * FROM administrador WHERE (Usuario = ? OR Correo = ?) AND role = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $username, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($password, $user['Contraseña'])) {
            // Iniciar la sesión y almacenar datos del usuario
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['Usuario'];
            $_SESSION['role'] = $role;

            // Redirigir según el rol
            if ($role == 'admin') {
                header("Location: InterfazPrinRegistro.php");
            } else if ($role == 'employee') {
                header("Location: InterfazPrinRegistroEMP.php");
            }
            exit;
        } else {
            $error_message = "Contraseña incorrecta.";
        }
    } else {
        $error_message = "Usuario no encontrado o rol incorrecto.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <a href="inicio_sesion.php">Volver a intentar</a>
    </div>
</body>
</html>
