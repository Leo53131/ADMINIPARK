<?php
class Vehiculo {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function listarVehiculos() {
        $query = "SELECT * FROM vehiculo"; // Cambia 'vehiculos' por el nombre de tu tabla
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarVehiculo($matricula, $marca, $modelo) {
        $query = "INSERT INTO vehiculo (matricula, marca, modelo) VALUES (:matricula, :marca, :modelo)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        return $stmt->execute();
    }

    public function obtenerVehiculo($idVehiculo) {
        $query = "SELECT * FROM vehiculo WHERE idVehiculo = :idVehiculo"; // Cambia 'idVehiculo' por el nombre de tu campo ID
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':idVehiculo', $idVehiculo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarVehiculo($idVehiculo, $matricula, $marca, $modelo) {
        $query = "UPDATE vehiculo SET matricula = :matricula, marca = :marca, modelo = :modelo WHERE idVehiculo = :idVehiculo";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':idVehiculo', $idVehiculo);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        return $stmt->execute();
    }

    public function eliminarVehiculo($idVehiculo) {
        $query = "DELETE FROM vehiculo WHERE idVehiculo = :idVehiculo";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':idVehiculo', $idVehiculo);
        return $stmt->execute();
    }
}
?>