<?php
include '../conexion/conexion.php';
include '../controladores/propietariocontroller.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar entradas
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    if (empty($username) || empty($password) || empty($role)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Encriptar la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Inicializar el controlador
        $controller = new PropietarioController($conexion);

        // Llamar a la función para agregar propietario
        $success = $controller->agregarPropietario($username, $role, $hashedPassword);

        if ($success) {
            echo json_encode(['success' => true, 'id' => $conexion->insert_id]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al agregar empleado.']);
        }
    } catch (Exception $e) {
        // Capturar cualquier excepción
        echo json_encode(['success' => false, 'message' => 'Error interno: ' . $e->getMessage()]);
    }
}
?>
