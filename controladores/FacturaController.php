<?php
include '../conexion/conexion.php';
include '../modelos/Factura.php';

class FacturaController {
    private $factura;

    public function __construct($conexion) {
        $this->factura = new Factura($conexion);
    }

    public function registrar() {
        if (isset($_POST['registrarFactura'])) {
            $placa = $_POST['placa'];
            $usuario = $_POST['usuario'];
            $horaEntrada = $_POST['horaEntrada'];
            $horaSalida = $_POST['horaSalida'];
            $valorHora = $_POST['valorHora'];
            $total = $_POST['total'];

            if ($this->factura->registrar($placa, $usuario, $horaEntrada, $horaSalida, $valorHora, $total)) {
                echo "Registro de factura exitoso";
            } else {
                echo "Error al registrar la factura";
            }
        }
    }

    public function listarFacturas() {
        return $this->factura->listar();
    }
}
?>