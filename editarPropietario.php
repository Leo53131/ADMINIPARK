<?php
include '../conexion/conexion.php';
include '../controladores/propietariocontroller.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    // Aquí deberías encriptar la nueva contraseña si se proporciona
    if ($password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    $controller = new PropietarioController($conexion);
    $success = $controller->editarPropietario($id, $username, $role, $hashedPassword);

    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al editar empleado.']);
    }
}
?>