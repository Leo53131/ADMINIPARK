<?php
class Factura {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function listarFacturas() {
        $query = "SELECT * FROM factura"; // Cambia 'facturas' por el nombre de tu tabla
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarFactura($placa, $usuario, $horaEntrada, $horaSalida, $valorHora) {
        $query = "INSERT INTO factura (placa, usuario, hora_entrada, hora_salida, valor_hora) VALUES (:placa, :usuario, :horaEntrada, :horaSalida, :valorHora)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':placa', $placa);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':horaEntrada', $horaEntrada);
        $stmt->bindParam(':horaSalida', $horaSalida);
        $stmt->bindParam(':valorHora', $valorHora);
        return $stmt->execute();
    }

    public function obtenerFactura($id) {
        $query = "SELECT * FROM factura WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarFactura($id, $placa, $usuario, $horaEntrada, $horaSalida, $valorHora) {
        $query = "UPDATE factura SET placa = :placa, usuario = :usuario, hora_entrada = :horaEntrada, hora_salida = :horaSalida, valor_hora = :valorHora WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':placa', $placa);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':horaEntrada', $horaEntrada);
        $stmt->bindParam(':horaSalida', $horaSalida);
        $stmt->bindParam(':valorHora', $valorHora);
        return $stmt->execute();
    }

    public function eliminarFactura($id) {
        $query = "DELETE FROM factura WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>