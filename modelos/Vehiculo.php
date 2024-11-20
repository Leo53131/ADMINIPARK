<?php
class Vehiculo {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrar($matricula, $marca, $modelo, $color) {
        try {
            $sql = "INSERT INTO vehiculos (matricula, marca, modelo, color) VALUES (:matricula, :marca, :modelo, :color)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':marca', $marca);
            $stmt->bindParam(':modelo', $modelo);
            $stmt->bindParam(':color', $color);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM vehiculos";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>