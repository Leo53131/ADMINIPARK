<?php
session_start();

// Inicializar el array de empleados en la sesión
if (!isset($_SESSION['employees'])) {
    $_SESSION['employees'] = [];
}

// Manejar el registro de un nuevo empleado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    if ($username && $password && $role !== '-- Seleccione un rol --') {
        $_SESSION['employees'][] = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Almacenar la contraseña de forma segura
            'role' => $role
        ];
    }

    // Devolver la lista de empleados
    echo json_encode($_SESSION['employees']);
    exit;
}

// Si se accede directamente al archivo, redirigir o mostrar un mensaje
header('HTTP/1.0 403 Forbidden');
echo 'Acceso no permitido';
exit;
?>