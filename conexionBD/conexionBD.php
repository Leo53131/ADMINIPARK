<?php
$host = 'localhost:3306'; 
$db = 'mydb';
$user = 'root';
$pass = '02082005';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Configurar PDO para mostrar errores de SQL
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>
