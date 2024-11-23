<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    // Redirigir a la interfaz principal según el rol del usuario
    $rol = $_SESSION['usuario']['rol']; // Suponiendo que el rol se almacena en la sesión

    if ($rol === 'admin') {
        header('Location: VISTA/empleadoA.php'); // Redirigir a la interfaz de administrador
    } elseif ($rol === 'employee') {
        header('Location: VISTA/clenteE.php'); // Redirigir a la interfaz de empleado
    }
    exit();
} else {
    // Si no hay sesión activa, redirigir a la página de inicio de sesión
    header('Location: VISTA/login.php');
    exit();
}
?>
