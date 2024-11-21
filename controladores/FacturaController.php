<?php
require_once '../modelos/Factura.php';

class FacturaController {
    private $factura;

    public function __construct($conexion) {
        $this->factura = new Factura($conexion);
    }

    public function listarFacturas() {
        try {
            return $this->factura->listarFacturas();
        } catch (Exception $e) {
            error_log("Error al listar facturas: " . $e->getMessage());
            throw new Exception("Error al listar facturas");
        }
    }

    public function agregarFactura($placa, $usuario, $horaEntrada, $horaSalida, $valorHora) {
        try {
            return $this->factura->agregarFactura($placa, $usuario, $horaEntrada, $horaSalida, $valorHora);
        } catch (Exception $e) {
            error_log("Error al agregar factura: " . $e->getMessage());
            throw new Exception("Error al agregar factura");
        }
    }

    public function obtenerFactura($id) {
        try {
            return $this->factura->obtenerFactura($id);
        } catch (Exception $e) {
            error_log("Error al obtener factura: " . $e->getMessage());
            throw new Exception("Error al obtener factura");
        }
    }

    public function actualizarFactura($id, $placa, $usuario, $horaEntrada, $horaSalida, $valorHora) {
        try {
            return $this->factura->actualizarFactura($id, $placa, $usuario, $horaEntrada, $horaSalida, $valorHora);
        } catch (Exception $e) {
            error_log("Error al actualizar factura: " . $e->getMessage());
            throw new Exception("Error al actualizar factura");
        }
    }

    public function eliminarFactura($id) {
        try {
            return $this->factura->eliminarFactura($id);
        } catch (Exception $e) {
            error_log("Error al eliminar factura: " . $e->getMessage());
            throw new Exception("Error al eliminar factura");
        }
    }
}
?>
