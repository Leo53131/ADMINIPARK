<?php
class Usuario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrar($nombre, $apellido, $correo, $nombreUsuario, $contrasena, $idRol) {
        try {
            // Preparar la consulta SQL para insertar el nuevo usuario
            $sql = "INSERT INTO usuarios (nombre, apellido, correo, nombreUsuario, contrasena, idRol) VALUES (:nombre, :apellido, :correo, :nombreUsuario, :contrasena, :idRol)";
            $stmt = $this->conexion->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':nombreUsuario', $nombreUsuario);
            $stmt->bindParam(':contrasena', password_hash($contrasena, PASSWORD_DEFAULT)); // Encriptar la contraseña
            $stmt->bindParam(':idRol', $idRol);

            // Ejecutar la consulta
            $stmt->execute();
            return "Registro exitoso"; // Mensaje de éxito
        } catch (PDOException $e) {
            // Manejo de errores
            return "Error al registrar el usuario: " . $e->getMessage(); // Mensaje de error
        }
    }

    public function login($nombreUsuario, $contrasena) {
        // Preparar la consulta SQL para buscar al usuario
        $sql = "SELECT * FROM usuarios WHERE nombreUsuario = :nombreUsuario";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombreUsuario', $nombreUsuario);
        $stmt->execute();

        // Obtener el usuario encontrado
        $usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar la contraseña
        if ($usuarioEncontrado && password_verify($contrasena, $usuarioEncontrado['contrasena'])) {
            return $usuarioEncontrado; // Devuelve el usuario encontrado
        }
        return false; // Fallo en la autenticación
    }

    public function listar() {
        try {
            // Preparar la consulta SQL para listar todos los usuarios
            $sql = "SELECT * FROM usuarios";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();

            // Devolver todos los usuarios
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejo de errores
            return [];
        }
    }
}
?>