<?php
class Usuario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrar($nombre, $apellido, $correo, $usuario, $contraseña) {
        try {
            $sql = "INSERT INTO administrador (Nombre, Apellido, Correo, Usuario, password) VALUES (:Nombre, :Apellido, :Correo, :Usuario, :password)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':Nombre', $nombre);
            $stmt->bindParam(':Apellido', $apellido);
            $stmt->bindParam(':Correo', $correo);
            $stmt->bindParam(':Usuario', $usuario);
            $stmt->bindParam(':password', password_hash($contraseña, PASSWORD_DEFAULT)); // Hashear la contraseña
            $stmt->execute();
            return true; // Registro exitoso
        } catch (PDOException $e) {
            return false; // Error en el registro
        }
    }

    public function login($usuario, $contraseña, $rol) {
        // Aquí asumimos que tienes dos tablas: 'administrador' y 'empleado'
        if ($rol === 'administrador') {
            $sql = "SELECT * FROM administrador WHERE Usuario = :Usuario";
        } else {
            $sql = "SELECT * FROM empleado WHERE Usuario = :Usuario";
        }
    
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':Usuario', $usuario);
        $stmt->execute();
        $usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verificar si el usuario fue encontrado y si la contraseña es correcta
        if ($usuarioEncontrado && password_verify($contraseña, $usuarioEncontrado['password'])) {
            return $usuarioEncontrado; // Autenticación exitosa
        }
        return false; // Fallo en la autenticación
    }
    public function listar() {
        try {
            $sql = "SELECT * FROM administrador"; // Cambia esto si también necesitas empleados
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los usuarios
        } catch (PDOException $e) {
            return []; // Retorna un array vacío en caso de error
        }
    }
}

?>