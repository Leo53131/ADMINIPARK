<?php
include 'db.php'; // Asegúrate de que este archivo contenga la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];

    // Verifica si el correo existe en la base de datos
    $stmt = $conn->prepare("SELECT * FROM Administrador WHERE Correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // El correo existe, generar un token de restablecimiento
        $token = bin2hex(random_bytes(50)); // Generar un token aleatorio
        $stmt = $conn->prepare("UPDATE Administrador SET reset_token = ? WHERE Correo = ?");
        $stmt->bind_param("ss", $token, $correo);
        $stmt->execute();

        // Enviar correo electrónico con el enlace de restablecimiento
        $resetLink = "http://tu_dominio.com/reset_password.php?token=" . $token; // Cambia esto a tu dominio
        $subject = "Restablecer tu contraseña";
        $message = "Haz clic en el siguiente enlace para restablecer tu contraseña: " . $resetLink;
        mail($correo, $subject, $message); // Asegúrate de tener configurado el servidor de correo

        echo "Se ha enviado un enlace para restablecer tu contraseña a tu correo electrónico.";
    } else {
        echo "El correo electrónico no está registrado.";
    }

    $stmt->close();
    $conn->close();
}
?>