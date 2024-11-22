<?php
include '../conexion/conexion.php';
include '../modelos/Usuario.php';

class UsuarioController {
    private $usuario;

    public function __construct($conexion) {
        $this->usuario = new Usuario($conexion);
    }

    public function listarUsuarios() {
        return $this->usuario->listar();
    }

    public function registrar() {
        if (isset($_POST['registrar'])) {
            $nombre = $_POST['Nombre'];
            $apellido = $_POST['Apellido'];
            $correo = $_POST['Correo'];
            $nombreUsuario = $_POST['Usuario'];
            $contrasena = $_POST['password'];

            // Asignar rol de administrador (1) de forma predeterminada
            $idRol = 1;

            // Llamar al método registrar y obtener el mensaje
            $mensaje = $this->usuario->registrar($nombre, $apellido, $correo, $nombreUsuario, $contrasena, $idRol);
            echo $mensaje; // Mostrar el mensaje de registro
        }
    }

    public function login() {
        if (isset($_POST['login'])) {
            $nombreUsuario = $_POST['Usuario'];
            $contrasena = $_POST['password'];

            // Autenticación del usuario
            $usuarioAutenticado = $this->usuario->login($nombreUsuario, $contrasena);
            if ($usuarioAutenticado) {
                // Iniciar sesión y redirigir según el rol
                session_start();
                $_SESSION['usuario'] = $usuarioAutenticado; // Almacenar información del usuario en la sesión

                // Redirigir según el rol del usuario
                if ($usuarioAutenticado['id Rol'] == 1) {
                    header("Location: admin_dashboard.php"); // Redirigir a panel de administrador
                } else {
                    header("Location: user_dashboard.php"); // Redirigir a panel de usuario
                }
                exit();
            } else {
                echo "Nombre de usuario o contraseña incorrectos"; // Mensaje de error
            }
        }
    }
}
?>