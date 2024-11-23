<?php
// EmpleadoController.php
require_once '../models/Empleado.php';

class EmpleadoController {

    private $db;
    private $empleadoModel;

    public function __construct($db) {
        $this->db = $db;
        $this->empleadoModel = new Empleado($db);
    }

    public function agregar() {
        $data = json_decode(file_get_contents("php://input"));
        
        // Sanitizar y validar los datos (esto es un ejemplo, agrega validaciones adicionales)
        $nombre = htmlspecialchars($data->nombre);
        $apellido = htmlspecialchars($data->apellido);
        $correo = htmlspecialchars($data->correo);
        $nombreUsuario = htmlspecialchars($data->nombreUsuario);
        $contrasena = password_hash($data->contrasena, PASSWORD_DEFAULT); // Asegurarse de encriptar la contraseña
        $rol = htmlspecialchars($data->rol);

        // Llamar al modelo para agregar el empleado
        if ($this->empleadoModel->agregarEmpleado($nombre, $apellido, $correo, $nombreUsuario, $contrasena, $rol)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo agregar el empleado.']);
        }
    }

    public function actualizar() {
        $data = json_decode(file_get_contents("php://input"));
        
        // Sanitizar y validar los datos
        $id = htmlspecialchars($data->id);
        $nombre = htmlspecialchars($data->nombre);
        $apellido = htmlspecialchars($data->apellido);
        $correo = htmlspecialchars($data->correo);
        $nombreUsuario = htmlspecialchars($data->nombreUsuario);
        $contrasena = password_hash($data->contrasena, PASSWORD_DEFAULT); // Asegurarse de encriptar la contraseña
        $rol = htmlspecialchars($data->rol);

        // Llamar al modelo para actualizar el empleado
        if ($this->empleadoModel->actualizarEmpleado($id, $nombre, $apellido, $correo, $nombreUsuario, $contrasena, $rol)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el empleado.']);
        }
    }
}
?>
