<?php
require_once '../modelos/propietario.php';

class PropietarioController {
    private $propietario;

    public function __construct($conexion) {
        $this->propietario = new Propietario($conexion);
    }

    public function listarPropietarios() {
        return $this->propietario->listar();
    }

    public function registrarPropietario($nombre, $apellido, $celular, $correo) {
        return $this->propietario->registrar($nombre, $apellido, $celular, $correo);
    }

    public function editarPropietario($id, $nombre, $apellido, $celular, $correo) {
        return $this->propietario->editar($id, $nombre, $apellido, $celular, $correo);
    }

    public function agregarPropietario($username, $role, $hashedPassword) {
        try {
            $id = $this->propietario->agregar($username, $role, $hashedPassword);
            if ($id) {
                return ['success' => true, 'id' => $id];
            } else {
                return ['success' => false, 'message' => 'Error al agregar el propietario.'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
?>