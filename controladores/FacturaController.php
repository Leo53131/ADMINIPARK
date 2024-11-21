<?php
include '../modelos/Factura.php'; // Asegúrate de que la ruta sea correcta

class FacturaController {
    private $factura;

    public function __construct($conexion) {
        $this->factura = new Factura($conexion);
    }

    public function listarFacturas() {
        return $this->factura->listarFacturas();
    }

    public function agregarFactura($placa, $usuario, $horaEntrada, $horaSalida, $valorHora) {
        return $this->factura->agregarFactura($placa, $usuario, $horaEntrada, $horaSalida, $valorHora);
    }

    public function obtenerFactura($id) {
        return $this->factura->obtenerFactura($id);
    }

    public function actualizarFactura($id, $placa, $usuario, $horaEntrada, $horaSalida, $valorHora) {
        return $this->factura->actualizarFactura($id, $placa, $usuario, $horaEntrada, $horaSalida, $valorHora);
    }

    public function eliminarFactura($id) {
        return $this->factura->eliminarFactura($id);
    }
}
?>