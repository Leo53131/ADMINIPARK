<?php
// UsuarioController.php

include '../modelos/usuario.php';

class UsuarioController {

    private $modeloUsuario;

    public function __construct($conn) {
        $this->modeloUsuario = new ModeloUsuario($conn);
    }

    public function login($username, $password, $role) {
        $result = $this->modeloUsuario->validarUsuario($username, $password, $role);
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['Contraseña'])) {
                // Iniciar sesión
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['Usuario'];
                $_SESSION['role'] = $role;

                if ($role == 'admin') {
                    header("Location: empleadoA.php");
                } else if ($role == 'employee') {
                    header("Location: clienteE.php");
                }
                exit;
            } else {
                return "Contraseña incorrecta.";
            }
        } else {
            return "Usuario no encontrado o rol incorrecto.";
        }
    }
}
?>
