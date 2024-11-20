<?php
include '../conexion/conexion.php';
include '../modelos/Vehiculo.php';

class VehiculoController {
    private $vehiculo;

    public function __construct($conexion) {
        $this->vehiculo = new Vehiculo($conexion);
    }

    public function registrar() {
        if (isset($_POST['registrarVehiculo'])) {
            $matricula = $_POST['matricula'];
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $color = $_POST['color'];

            if ($this->vehiculo->registrar($matricula, $marca, $modelo, $color)) {
                echo "Registro de vehículo exitoso";
            } else {
                echo "Error al registrar el vehículo";
            }
        }
    }

    public function listarVehiculos() {
        return $this->vehiculo->listar();
    }
}
?>