<?php
include 'db.php';

// Agregar un nuevo vehículo
function agregarVehiculo($placa, $marca, $modelo, $color, $hora_entrada, $idPropietario) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO mydb.Vehiculo (Placa, Marca, Modelo, Color, Hora_entrada, Propietario_idPropietario) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $placa, $marca, $modelo, $color, $hora_entrada, $idPropietario);
    $stmt->execute();
    $stmt->close();
}

// Obtener todos los vehículos de un propietario
function obtenerVehiculos($idPropietario) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM mydb.Vehiculo WHERE Propietario_idPropietario = ?");
    $stmt->bind_param("i", $idPropietario);
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