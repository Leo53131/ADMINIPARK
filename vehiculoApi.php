<?php
require_once '../conexion/conexion.php';
require_once '../controladores/VehiculoController.php';

$conexionObj = new Conexion();
$conexion = $conexionObj->conectar();
$controller = new VehiculoController($conexion);

$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestMethod) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['action'])) {
            switch ($data['action']) {
                case 'register':
                    $result = $controller->agregarVehiculo($data['matricula'], $data['marca'], $data['modelo'], $data['color']);
                    echo json_encode(['success' => $result]);
                    break;
                case 'update':
                    $result = $controller->actualizarVehiculo($data['id'], $data['matricula'], $data['marca'], $data['modelo'], $data['color']);
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
            $vehiculo = $controller->obtenerVehiculo($_GET['id']);
            echo json_encode($vehiculo);
        } elseif (isset($_GET['action']) && $_GET['action'] === 'list') {
            $vehiculos = $controller->listarVehiculos();
            echo json_encode($vehiculos);
        } else {
            echo json_encode(['success' => false, 'message' => 'Acción no válida o ID no especificado']);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $result = $controller->eliminarVehiculo($_GET['id']);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no especificado']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        break;
}
?>

