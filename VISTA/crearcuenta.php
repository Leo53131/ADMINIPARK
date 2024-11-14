<?php
// Incluir la conexión PDO
include '../conexionBD/conexionBD.php';

// Verificar si se ha enviado el formulario
if (isset($_POST['registrar'])) {
    // Recoger los datos del formulario
    $Nombre = $_POST['Nombre'];
    $Apellido = $_POST['Apellido'];
    $Correo = $_POST['Correo'];
    $Usuario = $_POST['Usuario'];
    $Contraseña = $_POST['password']; 

    try {
        // Preparar la consulta SQL
        $sql = "INSERT INTO administrador (Nombre, Apellido, Correo, Usuario, password) 
                VALUES (:Nombre, :Apellido, :Correo, :Usuario, :password)";
        
        // Preparar la sentencia
        $stmt = $conexion->prepare($sql);
        
        // Vincular los parámetros
        $stmt->bindParam(':Nombre', $Nombre);
        $stmt->bindParam(':Apellido', $Apellido);
        $stmt->bindParam(':Correo', $Correo);
        $stmt->bindParam(':Usuario', $Usuario);
        $stmt->bindParam(':password', $Contraseña);
        
        // Ejecutar la consulta
        $stmt->execute();

        // Mensaje de éxito
        echo "Registro exitoso";

    } catch (PDOException $e) {
        // Mensaje de error en caso de fallo
        echo "Error: " . $e->getMessage();
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
        <div class="encabezado">
            <h2>Crear una cuenta nueva</h2>
            <h5>¿Ya te registraste? Inicia sesión aquí</h5>
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
                <input type="password" name="password" placeholder="*************" required>
            </div>
        
            <button type="submit" name="registrar" class="Registrarse">Registrarse</button>
        </form>
    </div>
</div>

</body>
</html>
