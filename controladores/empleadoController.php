<?php
include '../modelos/empleado.php';

class EmpleadoController {
    private $model;

    public function __construct($conexion) {
        $this->model = new EmpleadoModel($conexion);
    }

    public function registrarEmpleado() {
        $data = json_decode(file_get_contents("php://input"), true);
        $username = $data['username'];
        $password = $data['password'];
        $role = $data['role'];

        if ($this->model->registrarEmpleado($username, $password, $role)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar el empleado.']);
        }
    }

    public function listarEmpleados() {
        echo json_encode($this->model->listarEmpleados());
    }

    public function actualizarEmpleado() {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        $username = $data['username'];
        $password = $data['password'];
        $role = $data['role'];

        if ($this->model->actualizarEmpleado($id, $username, $password, $role)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el empleado.']);
        }
    }
}

// Manejo de las acciones
$conexion = new Conexion();
$conexion = $conexion->conectar();
$controller = new EmpleadoController($conexion);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'register':
                $controller->registrarEmpleado();
                break;
            case 'update':
                $controller->actualizarEmpleado();
                break;
        }
    }
}