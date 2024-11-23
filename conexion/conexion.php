<?php
// Conexion.php
class Conexion {
    private $host = 'localhost:3306';
    private $db = 'mybd';
    private $user = 'root';
    private $pass = '12345678';
    private $conexion;

    // Método para conectar a la base de datos
    public function conectar() {
        try {
            // Establecer la conexión utilizando PDO
            $this->conexion = new PDO("mysql:host={$this->host};dbname={$this->db};charset=utf8", $this->user, $this->pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conexion;
        } catch (PDOException $e) {
            // Capturar errores y mostrarlos
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }
}
?>
