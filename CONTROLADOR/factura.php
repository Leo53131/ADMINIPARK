<?php
include 'db.php';

// Agregar una nueva factura
function agregarFactura($idVehiculo, $idUsuario, $hora_entrada, $valor_hora, $total, $idEmpleado) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO mydb.Factura (idVehiculo, idUsuario, Hora_entrada, Valor_hora, Total, idEmpleado, Vehiculo_idVehiculo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $idVehiculo, $idUsuario, $hora_entrada, $valor_hora, $total, $idEmpleado, $idVehiculo);
    $stmt->execute();
    $stmt->close();
}

// Obtener todas las facturas de un vehículo
function obtenerFacturas($idVehiculo) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM mydb.Factura WHERE Vehiculo_idVehiculo = ?");
    $stmt->bind_param("i", $idVehiculo);
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