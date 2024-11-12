<?php
include 'db.php';

// Agregar un nuevo propietario
function agregarPropietario($nombre_completo, $correo, $numero_telefono, $idEmpleado) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO mydb.Propietario (Nombre_completo, Correo, Numero_telefono, Empleado_idEmpleado) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nombre_completo, $correo, $numero_telefono, $idEmpleado);
    $stmt->execute();
    $stmt->close();
}

// Obtener todos los propietarios de un empleado
function obtenerPropietarios($idEmpleado) {
    global $conn;
    $stmt = $conn->prepare(" SELECT * FROM mydb.Propietario WHERE Empleado_idEmpleado = ?");
    $stmt->bind_param("i", $idEmpleado);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);
}

// Cerrar conexión
function cerrarConexion() {
    global $conn;
    $conn->close();
}
?>