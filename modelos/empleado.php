<?php
class EmpleadoModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Listar empleados
    public function listarEmpleados() {
        $query = "SELECT * FROM empleados"; // Cambia 'empleados' por el nombre de tu tabla
        $result = $this->conexion->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Agregar nuevo empleado
    public function agregarEmpleado($usuario, $contrasena, $rol) {
        $query = "INSERT INTO empleados (usuario, contrasena, rol) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("sss", $usuario, $contrasena, $rol);
        return $stmt->execute();
    }

    // Obtener empleado por ID
    public function obtenerEmpleado($id) {
        $query = "SELECT * FROM empleados WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizar empleado
    public function actualizarEmpleado($id, $usuario, $contrasena, $rol) {
        $query = "UPDATE empleados SET usuario = ?, contrasena = ?, rol = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("sssi", $usuario, $contrasena, $rol, $id);
        return $stmt->execute();
    }
}
?>