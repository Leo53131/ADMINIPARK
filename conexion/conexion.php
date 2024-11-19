<?php
$host = '127.0.0.1:3306'; 
$db = 'mydb';
$user = 'root';
$pass = '12345678';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Configurar PDO para mostrar errores de SQL
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>