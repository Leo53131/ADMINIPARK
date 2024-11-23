<?php
class Empleado {
    private $db;
    private $table = 'empleados';

    public function __construct($db) {
        $this->db = $db;
    }

    public function agregarEmpleado($nombre, $apellido, $correo, $nombreUsuario, $contrasena, $rol) {
        $query = "INSERT INTO $this->table (nombre, apellido, correo, nombreUsuario, contrasena, rol) VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssss", $nombre, $apellido, $correo, $nombreUsuario, $contrasena, $rol);

        return $stmt->execute();
    }

    public function actualizarEmpleado($id, $nombre, $apellido, $correo, $nombreUsuario, $contrasena, $rol) {
        $query = "UPDATE $this->table SET nombre = ?, apellido = ?, correo = ?, nombreUsuario = ?, contrasena = ?, rol = ? WHERE idEmpleado = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssssi", $nombre, $apellido, $correo, $nombreUsuario, $contrasena, $rol, $id);

        return $stmt->execute();
    }
}
?>
