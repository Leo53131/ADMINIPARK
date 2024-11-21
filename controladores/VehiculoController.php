<?php
include '../modelos/Vehiculo.php'; // Asegúrate de que la ruta sea correcta

class VehiculoController {
    private $vehiculo;

    public function __construct($conexion) {
        $this->vehiculo = new Vehiculo($conexion);
    }

    public function listarVehiculos() {
        return $this->vehiculo->listarVehiculos();
    }

    public function agregarVehiculo($matricula, $marca, $modelo) {
        return $this->vehiculo->agregarVehiculo($matricula, $marca, $modelo);
    }

    public function obtenerVehiculo($idVehiculo) {
        return $this->vehiculo->obtenerVehiculo($idVehiculo);
    }

    public function actualizarVehiculo($idVehiculo, $matricula, $marca, $modelo) {
        return $this->vehiculo->actualizarVehiculo($idVehiculo, $matricula, $marca, $modelo);
    }

    public function eliminarVehiculo($idVehiculo) {
        return $this->vehiculo->eliminarVehiculo($idVehiculo);
    }
}
?>