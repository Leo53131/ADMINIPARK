<?php
class Empleado {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function listarEmpleados() {
        $query = "SELECT * FROM empleado"; // Cambia 'empleados' por el nombre de tu tabla
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarEmpleado($username, $password, $role) {
        $query = "INSERT INTO empleado (Nombre_Usuario, Contraseña, Rol) VALUES (:username, :password, :role)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT)); // Asegúrate de hashear la contraseña
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    public function obtenerEmpleado($id) {
        $query = "SELECT * FROM empleado WHERE idEmpleado = :id"; // Cambia 'idEmpleado' por el nombre de tu campo ID
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarEmpleado($id, $username, $password, $role) {
        $query = "UPDATE empleado SET Nombre_Usuario = :username, Rol = :role" . ($password ? ", Contraseña = :password" : "") . " WHERE idEmpleado = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        if ($password) {
            $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
        }
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    public function eliminarEmpleado($id) {
        $query = "DELETE FROM empleado WHERE idEmpleado = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function toggleEstado($id, $estado) {
        $query = "UPDATE empleado SET Estado = :estado WHERE idEmpleado = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':estado', $estado);
        return $stmt->execute();
    }
}
?>