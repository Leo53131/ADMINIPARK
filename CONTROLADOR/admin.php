<?php
include 'db.php';

// Agregar un nuevo administrador
function agregarAdministrador($nombre, $apellido, $usuario, $contraseña) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO mydb.Administrador (Nombre, Apellido, Usuario, Contraseña, activo) VALUES (?, ?, ?, ?, 1)");
    $stmt->bind_param("ssss", $nombre, $apellido, $usuario, $contraseña);
    $stmt->execute();
    $stmt->close();
}

// Obtener todos los administradores
function obtenerAdministradores() {
    global $conn;
    $resultado = $conn->query("SELECT * FROM mydb.Administrador WHERE activo = 1");
    return $resultado->fetch_all(MYSQLI_ASSOC);
}

// Deshabilitar un administrador
function deshabilitarAdministrador($idAdministrador) {
    global $conn;
    $stmt = $conn->prepare("UPDATE mydb.Administrador SET activo = 0 WHERE idAdministrador = ?");
    $stmt->bind_param("i", $idAdministrador);
    $stmt->execute();
    $stmt->close();
}

// Cerrar conexión
function cerrarConexion() {
    global $conn;
    $conn->close();
}
?>