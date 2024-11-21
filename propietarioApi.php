<?php
require_once '../conexion/conexion.php';
require_once '../controladores/PropietarioController.php';

$conexionObj = new Conexion();
$conexion = $conexionObj->conectar();
$controller = new PropietarioController($conexion);

$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestMethod) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['action']) && $data['action'] === 'register') {
            $result = $controller->agregarPropietario($data['nombre'], $data['apellido'], $data['correo']);
            echo json_encode(['success' => $result]);
        }
        break; // Asegúrate de que haya un punto y coma aquí

    case 'GET':
        if (isset($_GET['id'])) {
            $propietario = $controller->obtenerPropietario($_GET['id']);
            echo json_encode($propietario);
        } else {
            $propietarios = $controller->listarPropietarios();
            echo json_encode($propietarios);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['id'])) {
            $result = $controller->actualizarPropietario($data['id'], $data['nombre'], $data['apellido'], $data['correo']);
            echo json_encode(['success' => $result]);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['id'])) {
            $result = $controller->eliminarPropietario($data['id']);
            echo json_encode(['success' => $result]);
        }
        break;

    default:
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
?>