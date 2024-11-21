<?php
include '../modelos/Propietario.php'; // Asegúrate de que la ruta sea correcta

class PropietarioController {
    private $propietario;

    public function __construct($conexion) {
        $this->propietario = new Propietario($conexion);
    }

    public function listarPropietarios() {
        return $this->propietario->listarPropietarios();
    }

    public function agregarPropietario($nombre, $apellido, $correo) {
        return $this->propietario->agregarPropietario($nombre, $apellido, $correo);
    }

    public function obtenerPropietario($id) {
        return $this->propietario->obtenerPropietario($id);
    }

    public function actualizarPropietario($id, $nombre, $apellido, $correo) {
        return $this->propietario->actualizarPropietario($id, $nombre, $apellido, $correo);
    }

    public function eliminarPropietario($id) {
        return $this->propietario->eliminarPropietario($id);
    }
}
?>