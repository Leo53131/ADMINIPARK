<?php
class Factura {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrar($placa, $usuario, $horaEntrada, $horaSalida, $valorHora, $total) {
        try {
            $sql = "INSERT INTO facturas (placa, usuario, hora_entrada, hora_salida, valor_hora, total) VALUES (:placa, :usuario, :horaEntrada, :horaSalida, :valorHora, :total)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':placa', $placa);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':horaEntrada', $horaEntrada);
            $stmt->bindParam(':horaSalida', $horaSalida);
            $stmt->bindParam(':valorHora', $valorHora);
            $stmt->bindParam(':total', $total);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM facturas";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>