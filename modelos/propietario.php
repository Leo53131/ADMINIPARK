<?php
class Propietario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function listar() {
        $query = "SELECT * FROM propietario"; // Ajusta la consulta según tu base de datos
        $result = $this->conexion->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre, $apellido, $correo) {
        $query = "INSERT INTO propietario (Nombre, Apellido, Correo) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        return $stmt->execute([$nombre, $apellido, $correo]);
    }

    public function editar($id, $nombre, $apellido, $correo) {
        $query = "UPDATE propietario SET Nombre = ?, Apellido = ?, Correo = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        return $stmt->execute([$nombre, $apellido, $correo, $id]);
    }
}
?>