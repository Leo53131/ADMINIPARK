<?php
class EmpleadoModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrarEmpleado($username, $password, $role) {
        try {
            $stmt = $this->conexion->prepare("INSERT INTO empleado (Nombre_Usuario, Contraseña, Rol) VALUES (?, ?, ?)");
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hashear la contraseña
            $stmt->execute([$username, $hashedPassword, $role]);
            return true;
        } catch (PDOException $e) {
            error_log("Error al registrar empleado: " . $e->getMessage());
            return false;
        }
    }

    public function listarEmpleados() {
        try {
            $query = "SELECT idEmpleado, Nombre_Usuario, Rol FROM empleado";
            $stmt = $this->conexion->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Aquí se corrige el método fetchAll()
        } catch (PDOException $e) {
            error_log("Error al listar empleados: " . $e->getMessage());
            return [];
        }
    }

    public function actualizarEmpleado($id, $username, $password, $role) {
        try {
            $stmt = $this->conexion->prepare("UPDATE empleado SET Nombre_Usuario = ?, Contraseña = ?, Rol = ? WHERE idEmpleado = ?");
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hashear la contraseña
            $stmt->execute([$username, $hashedPassword, $role, $id]);
            return true;
        } catch (PDOException $e) {
            error_log("Error al actualizar empleado: " . $e->getMessage());
            return false;
        }
    }
}
