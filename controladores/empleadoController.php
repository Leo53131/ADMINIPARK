<?php
include 'EmpleadoModel.php'; // Asegúrate de incluir el modelo

class EmpleadoController {
    private $modelo;

    public function __construct($conexion) {
        $this->modelo = new EmpleadoModel($conexion);
    }

    // Listar empleados
    public function listarEmpleados() {
        return $this->modelo->listarEmpleados();
    }

    // Agregar nuevo empleado
    public function agregarEmpleado($usuario, $contrasena, $rol) {
        return $this->modelo->agregarEmpleado($usuario, $contrasena, $rol);
    }

    // Obtener empleado por ID
    public function obtenerEmpleado($id) {
        return $this->modelo->obtenerEmpleado($id);
    }

    // Actualizar empleado
    public function actualizarEmpleado($id, $usuario, $contrasena, $rol) {
        return $this->modelo->actualizarEmpleado($id, $usuario, $contrasena, $rol);
    }
}
?>