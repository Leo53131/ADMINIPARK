<?php
class Factura {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function listarFacturas() {
        try {
            $query = "SELECT * FROM factura";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en la base de datos: " . $e->getMessage());
            throw new Exception("Error al listar facturas");
        }
    }

    public function agregarFactura($placa, $usuario, $horaEntrada, $horaSalida, $valorHora) {
        if (empty($placa) || empty($usuario) || empty($horaEntrada) || empty($horaSalida) || !is_numeric($valorHora)) {
            throw new Exception("Datos de factura inválidos");
        }

        try {
            $query = "INSERT INTO factura (placa, usuario, hora_entrada, hora_salida, valor_hora) VALUES (:placa, :usuario, :horaEntrada, :horaSalida, :valorHora)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':placa', $placa);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':horaEntrada', $horaEntrada);
            $stmt->bindParam(':horaSalida', $horaSalida);
            $stmt->bindParam(':valorHora', $valorHora);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en la base de datos: " . $e->getMessage());
            throw new Exception("Error al agregar factura");
        }
    }

    public function obtenerFactura($id) {
        try {
            $query = "SELECT * FROM factura WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en la base de datos: " . $e->getMessage());
            throw new Exception("Error al obtener factura");
        }
    }

    public function actualizarFactura($id, $placa, $usuario, $horaEntrada, $horaSalida, $valorHora) {
        if (empty($id) || empty($placa) || empty($usuario) || empty($horaEntrada) || empty($horaSalida) || !is_numeric($valorHora)) {
            throw new Exception("Datos de factura inválidos");
        }

        try {
            $query = "UPDATE factura SET placa = :placa, usuario = :usuario, hora_entrada = :horaEntrada, hora_salida = :horaSalida, valor_hora = :valorHora WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':placa', $placa);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':horaEntrada', $horaEntrada);
            $stmt->bindParam(':horaSalida', $horaSalida);
            $stmt->bindParam(':valorHora', $valorHora);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en la base de datos: " . $e->getMessage());
            throw new Exception("Error al actualizar factura");
        }
    }

    public function eliminarFactura($id) {
        try {
            $query = "DELETE FROM factura WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en la base de datos: " . $e->getMessage());
            throw new Exception("Error al eliminar factura");
        }
    }
}
?>
