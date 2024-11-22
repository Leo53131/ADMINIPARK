<?php
class Empleado {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function listarEmpleadosPaginados($start, $perPage) {
        $sql = "SELECT e.*, r.nombreRol FROM empleado e
                JOIN rol r ON e.idRol = r.idRol
                LIMIT ?, ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $start, PDO::PARAM_INT);
        $stmt->bindValue(2, $perPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarEmpleados() {
        $sql = "SELECT COUNT(*) FROM empleado";
        return $this->db->query($sql)->fetchColumn();
    }

    public function obtenerEmpleado($id) {
        $sql = "SELECT e.*, r.nombreRol FROM empleado e
                JOIN rol r ON e.idRol = r.idRol
                WHERE e.idEmpleado = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregarEmpleado($nombre, $apellido, $correo, $usuario, $contrasena) {
        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
        $sql = "INSERT INTO empleado (nombre, apellido, nombreUsuario, contrasena, correo, idRol) 
                VALUES (?, ?, ?, ?, ?, 2)"; // 2 es el idRol para Empleado
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $apellido, $usuario, $contrasenaHash, $correo]);
    }

    public function actualizarEmpleado($id, $nombre, $apellido, $correo, $usuario, $contrasena = null) {
        if ($contrasena) {
            $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
            $sql = "UPDATE empleado SET nombre = ?, apellido = ?, nombreUsuario = ?, contrasena = ?, correo = ? WHERE idEmpleado = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$nombre, $apellido, $usuario, $contrasenaHash, $correo, $id]);
        } else {
            $sql = "UPDATE empleado SET nombre = ?, apellido = ?, nombreUsuario = ?, correo = ? WHERE idEmpleado = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$nombre, $apellido, $usuario, $correo, $id]);
        }
    }

    public function eliminarEmpleado($id) {
        $sql = "DELETE FROM empleado WHERE idEmpleado = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}

