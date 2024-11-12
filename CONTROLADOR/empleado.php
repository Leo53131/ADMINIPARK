<?php
include 'db.php';

// Agregar un nuevo empleado
function agregarEmpleado($rol, $nombre_usuario, $contraseña, $idAdministrador) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO mydb.Empleado (Rol, Nombre_Usuario, Contraseña, Administrador_idAdministrador, activo) VALUES (?, ?, ?, ?, 1)");
    $stmt->bind_param("ssss", $rol, $nombre_usuario, $contraseña, $idAdministrador);
    $stmt->execute();
    $stmt->close();
}

// Obtener todos los empleados de un administrador
function obtenerEmpleados($idAdministrador) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM mydb.Empleado WHERE Administrador_idAdministrador = ? AND activo = 1");
    $stmt->bind_param("i", $idAdministrador);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);
}

// Deshabilitar un empleado
function deshabilitarEmpleado($idEmpleado) {
    global $conn;
    $stmt = $conn->prepare("UPDATE mydb.Empleado SET activo = 0 WHERE idEmpleado = ?");
    $stmt->bind_param("i", $idEmpleado);
    $stmt->execute();
    $stmt->close();
}

// Cerrar conexión
function cerrarConexion() {
    global $conn;
    $conn->close();
}
?>