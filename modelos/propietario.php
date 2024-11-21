<?php
class Propietario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function listar() {
        // Asegúrate de que 'idPropietario' es el nombre correcto de la columna
        $query = "SELECT idPropietario, nombreCompleto, numeroCelular, correoElectronico FROM propietario";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre, $apellido, $celular, $correo) {
        // Inserta en las columnas correctas
        $query = "INSERT INTO propietario (nombreCompleto, numeroCelular, correoElectronico) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        return $stmt->execute([$nombre . ' ' . $apellido, $celular, $correo]);
    }

    public function editar($idPropietario, $nombre, $apellido, $celular, $correo) {
        // Actualiza en las columnas correctas
        $query = "UPDATE propietario SET nombreCompleto = ?, numeroCelular = ?, correoElectronico = ? WHERE idPropietario = ?";
        $stmt = $this->conexion->prepare($query);
        return $stmt->execute([$nombre . ' ' . $apellido, $celular, $correo, $idPropietario]);
    }

    public function agregar($username, $role, $hashedPassword) {
        // Asegúrate de que la tabla tenga las columnas necesarias
        $query = "INSERT INTO propietario (Username, Role, Password) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        if ($stmt->execute([$username, $role, $hashedPassword])) {
            return $this->conexion->lastInsertId();
        }
        return false;
    }
}
?>