<?php
require_once '../conexion/conexion.php';
require_once '../controladores/EmpleadoController.php';

$conexionObj = new Conexion();
$conexion = $conexionObj ->conectar();
$controller = new EmpleadoController($conexion);

$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestMethod) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['action'])) {
            switch ($data['action']) {
                case 'register':
                    $result = $controller->agregarEmpleado($data['username'], $data['password'], $data['role']);
                    echo json_encode(['success' => $result]);
                    break;
                case 'update':
                    $result = $controller->actualizarEmpleado($data['id'], $data['username'], $data['password'], $data['role']);
                    echo json_encode(['success' => $result]);
                    break;
                default:
                    echo json_encode(['success' => false, 'message' => 'Acción no válida']);
                    break;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No se especificó la acción']);
        }
        break;

    case 'GET':
        if (isset($_GET['id'])) {
            $empleado = $controller->obtenerEmpleado($_GET['id']);
            echo json_encode($empleado);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no especificado']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        break;
}
?>