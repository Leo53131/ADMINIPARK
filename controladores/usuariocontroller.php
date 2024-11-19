<?php
include '../conexion/conexion.php';
include '../modelos/Usuario.php';

class UsuarioController {
    private $usuario;

    public function __construct($conexion) {
        $this->usuario = new Usuario($conexion);
    }

    public function registrar() {
        if (isset($_POST['registrar'])) {
            $nombre = $_POST['Nombre'];
            $apellido = $_POST['Apellido'];
            $correo = $_POST['Correo'];
            $usuario = $_POST['Usuario'];
            $contraseña = $_POST['password'];

            if ($this->usuario->registrar($nombre, $apellido, $correo, $usuario, $contraseña)) {
                echo "Registro exitoso";
            } else {
                echo "Error al registrar el usuario";
            }
        }
    }

   // Continuación del UsuarioController.php

   public function login() {
    if (isset($_POST['login'])) {
        $usuario = $_POST['Usuario'];
        $contraseña = $_POST['password'];
        $rol = $_POST['role']; // Obtener el rol del formulario

        $usuarioAutenticado = $this->usuario->login($usuario, $contraseña, $rol);
        if ($usuarioAutenticado) {
            // Iniciar sesión y redirigir según el rol
            session_start();
            $_SESSION['usuario'] = $usuarioAutenticado; // Almacenar información del usuario en la sesión

            if ($rol === 'admin') {
                header('Location: ../vistas/InterfazPrinRegistro.php'); // Redirigir a la interfaz de administrador
            } elseif ($rol === 'employee') {
                header('Location: ../vistas/InterfazPrinRegistroEMP.php'); // Redirigir a la interfaz de empleado
            }
            exit();
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }
}
}

// Lógica para determinar si se registra o inicia sesión
$controller = new UsuarioController($conexion);
if (isset($_POST['registrar'])) {
    $controller->registrar();
} elseif (isset($_POST['login'])) {
    $controller->login();
}
?>