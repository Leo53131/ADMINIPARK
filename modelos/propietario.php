<?php
class Propietario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function listarPropietarios() {
        $query = "SELECT * FROM propietario"; // Cambia 'propietarios' por el nombre de tu tabla
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarPropietario($nombre, $apellido, $correo) {
        $query = "INSERT INTO propietario (Nombre, Apellido, Correo) VALUES (:nombre, :apellido, :correo)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':correo', $correo);
        return $stmt->execute();
    }

    public function obtenerPropietario($id) {
        $query = "SELECT * FROM propietario WHERE id = :id"; // Cambia 'id' por el nombre de tu campo ID
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarPropietario($id, $nombre, $apellido, $correo) {
        $query = "UPDATE propietario SET Nombre = :nombre, Apellido = :apellido, Correo = :correo WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':correo', $correo);
        return $stmt->execute();
    }

    public function eliminarPropietario($id) {
        $query = "DELETE FROM propietario WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>