<?php
include '../conexion/conexion.php';
include '../controladores/propietariocontroller.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Aquí deberías encriptar la contraseña antes de almacenarla
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $controller = new PropietarioController($conexion);
    $success = $controller->agregarPropietario($username, $role, $hashedPassword);

    if ($success) {
        echo json_encode(['success' => true, 'id' => $conexion->insert_id]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al agregar empleado.']);
    }
}
?>