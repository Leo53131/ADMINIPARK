<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $nueva_contraseña = $_POST['nueva_contraseña'];

    // Verificar el token
    $stmt = $conn->prepare("SELECT * FROM Administrador WHERE reset_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Token válido, actualizar la contraseña
        $stmt = $conn->prepare("UPDATE Administrador SET Contraseña = ?, reset_token = NULL WHERE reset_token = ?");
        $hashed_password = password_hash($nueva_contraseña, PASSWORD_DEFAULT); // Asegúrate de usar un hash seguro
        $stmt->bind_param("ss", $hashed_password, $token);
        $stmt->execute();

        echo "Tu contraseña ha sido restablecida con éxito.";
    } else {
        echo "Token inválido o expirado.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/styles_reset_password.css">
    <title>Restablecer Contraseña</title>
</head>

<body>
    <div class="contenedor">
        <div class="box">
            <div class="encabezado">
                <h2>Restablecer Contraseña</h2>
            </div>
            <form method="POST" action="">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
                <div>
                    <h4>Nueva Contraseña</h4>
                    <input type="password" name="nueva_contraseña" required>
                </div>
                <button type="submit" class="envia">Restablecer</button>
            </form>
        </div>
    </div>
</body>

</html>