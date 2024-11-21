<?php
include '../modelos/Empleado.php'; // Asegúrate de que la ruta sea correcta

class EmpleadoController {
    private $empleado;

    public function __construct($conexion) {
        $this->empleado = new Empleado($conexion);
    }

    public function listarEmpleados() {
        return $this->empleado->listarEmpleados();
    }

    public function agregarEmpleado($username, $password, $role) {
        return $this->empleado->agregarEmpleado($username, $password, $role);
    }

    public function obtenerEmpleado($id) {
        return $this->empleado->obtenerEmpleado($id);
    }

    public function actualizarEmpleado($id, $username, $password, $role) {
        return $this->empleado->actualizarEmpleado($id, $username, $password, $role);
    }

    public function eliminarEmpleado($id) {
        return $this->empleado->eliminarEmpleado($id);
    }
}
?>