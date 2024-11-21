<?php
class Conexion {
    private $conexion;

    public function conectar() {
        $host = '127.0.0.1:3306'; 
        $db = 'mydb';
        $user = 'root';
        $pass = '12345678';

        try {
            $this->conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conexion;
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
            return null;
        }
    }
}