<?php
// ModeloUsuario.php

include '../conexion/conexion.php';

class ModeloUsuario {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function validarUsuario($username, $password, $role) {
        $sql = "SELECT * FROM administrador WHERE (Usuario = ? OR Correo = ?) AND role = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $username, $username, $role);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function obtenerAdministradores() {
        $resultado = $this->conn->query("SELECT * FROM administrador WHERE activo = 1");
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>
