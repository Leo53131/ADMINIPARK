<?php
require_once '../conexion/conexion.php';
require_once '../controladores/FacturaController.php';

$conexionObj = new Conexion();
$conexion = $conexionObj->conectar(); // Asegúrate de que este método exista y se llame correctamente
$facturaController = new FacturaController($conexion);

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'listar':
        $facturas = $facturaController->listarFacturas();
        echo json_encode($facturas);
        break;

    case 'registrar':
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $facturaController->agregarFactura($data['placa'], $data['usuario'], $data['hora_entrada'], $data['hora_salida'], $data['valor_hora']);
        echo json_encode(['success' => $result]);
        break;

    case 'obtener':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $factura = $facturaController->obtenerFactura($id);
            echo json_encode($factura);
        } else {
            echo json_encode(['error' => 'ID no proporcionado']);
        }
        break;

    case 'actualizar':
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $facturaController->actualizarFactura($data['id'], $data['placa'], $data['usuario'], $data['hora_entrada'], $data['hora_salida'], $data['valor_hora']);
        echo json_encode(['success' => $result]);
        break;

    case 'eliminar':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $result = $facturaController->eliminarFactura($id);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['error' => 'ID no proporcionado']);
        }
        break;

    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}
?>