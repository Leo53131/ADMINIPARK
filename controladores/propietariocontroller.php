<?php
include '../modelos/Propietario.php';

class PropietarioController {
    private $propietario;

    public function __construct($conexion) {
        $this->propietario = new Propietario($conexion);
    }

    public function listarPropietarios() {
        return $this->propietario->listar();
    }

    public function registrarPropietario($nombre, $apellido, $correo) {
        return $this->propietario->registrar($nombre, $apellido, $correo);
    }

    public function editarPropietario($id, $nombre, $apellido, $correo) {
        return $this->propietario->editar($id, $nombre, $apellido, $correo);
    }

    // Agregar propietario con username, role y password
    public function agregarPropietario($username, $role, $hashedPassword) {
        return $this->propietario->agregar($username, $role, $hashedPassword);
    }
}
?>