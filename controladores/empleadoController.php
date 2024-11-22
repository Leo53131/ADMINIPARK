<?php
require_once '../modelos/Empleado.php';

class EmpleadoController {
    private $empleado;

    public function __construct($conexion) {
        $this->empleado = new Empleado($conexion);
    }

    public function listarEmpleadosPaginados($start, $perPage) {
        return $this->empleado->listarEmpleadosPaginados($start, $perPage);
    }

    public function contarEmpleados() {
        return $this->empleado->contarEmpleados();
    }

    public function obtenerEmpleado($id) {
        return $this->empleado->obtenerEmpleado($id);
    }

    public function agregarEmpleado($nombre, $apellido, $correo, $usuario, $contrasena) {
        return $this->empleado->agregarEmpleado($nombre, $apellido, $correo, $usuario, $contrasena);
    }

    public function actualizarEmpleado($id, $nombre, $apellido, $correo, $usuario, $contrasena = null) {
        return $this->empleado->actualizarEmpleado($id, $nombre, $apellido, $correo, $usuario, $contrasena);
    }

    public function eliminarEmpleado($id) {
        return $this->empleado->eliminarEmpleado($id);
    }
}

