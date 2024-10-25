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
}

// Obtener la lista de empleados
$employees = $_SESSION['employees'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../estilos/style_InterfazPrinRegistro.css">
    <title>Interfaz Principal Admin</title>
</head>
<body>
    <div class="parent">
        <div class="div1">
            <div class="top-bar">
                <div class="logo-container">
                    <img src="../imagenes/Logo vistas (1).png" alt="Logo">
                </div>
                <div class="top-right">
                    <div class="user-profile">
                        <i class="fas fa-user-circle"></i>
                        <span>Jimena Jiménez</span>
                    </div>
                    <div class="notification">
                        <i class="fas fa-bell"></i>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="div2">
            <div class="sidebar">
                <a href="#"><i class="fas fa-user"></i><span>Gestión de empleados</span></a>
                <a href="#"><i class="fas fa-users"></i><span>Usuarios</span></a>
                <a href="#"><i class="fas fa-car"></i><span>Vehículos</span></a>
                <a href="#"><i class="fas fa-file-invoice"></i><span>Factura</span></a>
                <a href="inicio_sesion.php"><i class="fas fa-sign-out-alt"></i><span>Salir</span></a>
            </div>
        </div>

        <div class="div3" id="content">
            
            </div>
        </div>
    </div>
</body>
</html>

<script>
    // Función para cambiar el contenido de div3
    function changeContent(content) {
        document.getElementById('content').innerHTML = content;

        // Agregar la funcionalidad de mostrar/ocultar contraseña
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function () {
                // Cambia el tipo de input entre 'password' y 'text'
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                // Cambia el ícono del ojo
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            });
        }

        // Cargar datos del formulario desde localStorage
        loadFormData();
    }

    // Función para guardar datos del formulario en localStorage
    function saveFormData() {
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const role = document.getElementById('role').value;

        localStorage.setItem('username', username);
        localStorage.setItem('password', password);
        localStorage.setItem('role', role);
    }

    // Función para cargar datos del formulario desde localStorage
    function loadFormData() {
        const username = localStorage.getItem('username') || '';
        const password = localStorage.getItem('password') || '';
        const role = localStorage.getItem('role') || '-- Seleccione un rol --';

        document.getElementById('username').value = username;
        document.getElementById('password').value = password;
        document.getElementById('role').value = role;
    }

    // Agregar eventos a los enlaces de la barra lateral
    document.querySelectorAll('.sidebar a').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Evitar el comportamiento por defecto del enlace
            const content = this.querySelector('span').textContent; // Obtener el texto del enlace

            // Cambiar el contenido según el enlace
            let newContent;
            switch (content) {
                case 'Gestión de empleados':
                    newContent = `
                       <!-- Contenedor general -->
            <div class="container">

        <!-- Contenido principal -->
        <div class="main-content">
            <h2 class="nunito-unique-600">Empleados</h2>
            <hr class="separator-line"> <!-- Línea naranja separadora -->

            <!-- Contenedor de búsqueda -->
            <div class="search-container">
                <input type="text" placeholder="Buscar empleados..." aria-label="Buscar empleados">
                <button type="button" class="nunito-unique-600">Agregar nuevo empleado</button>
            </div>

            <!-- Tabla de empleados registrados -->
            <div class="table-container">
                <h3 class="nunito-unique-600">Empleados registrados</h3>
                <p>Fecha de registro: 16 de octubre de 2024</p>
                <table class="employees-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fila de ejemplo para un empleado registrado -->
                        <tr>
                            <td>1</td>
                            <td>JuanObando</td>
                            <td>******</td>
                            <td>Admin</td>
                            <td class="action-buttons">
                                <i class="fas fa-edit" title="Editar"></i>
                                <i class="fas fa-trash" title="Eliminar"></i>
                                <i class="fas fa-pencil-alt" title="Modificar"></i>
                            </td>
                        </tr>
                        <!-- Fila adicional para agregar nuevo empleado -->
                        <tr>
                            <td>2</td>
                            <td><input type="text" placeholder="Usuario"></td>
                            <td><input type="password" placeholder="Contraseña"></td>
                            <td>
                                <select>
                                    <option>-- Seleccione un rol --</option>
                                    <option>Admin</option>
                                    <option>Empleado</option>
                                </select>
                            </td>
                            <td class="action-buttons">
                                <button type="submit" class="nunito-unique-600">Registrar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Contenedor de la paginación -->
            <div class="pagination">
                <button class="nunito-unique-600">Anterior</button>
                <button class="nunito-unique-600">1</button>
                <button class="nunito-unique-600">2</button>
                <button class="nunito-unique-600">Siguiente</button>
            </div>
        </div>
                    `;
                    break;
                case 'Usuarios':
                    newContent = '<h2>Usuarios</h2><p>Aquí puedes gestionar a los usuarios.</p>';
                    break;
                case 'Vehículos':
                    newContent = '<h2>Vehículos</ h2><p>Aquí puedes gestionar los vehículos.</p>';
                    break;
                case 'Factura':
                    newContent = '<h2>Factura</h2><p>Aquí puedes gestionar las facturas.</p>';
                    break;
                case 'Salir':
                    window.location.href = 'inicio_sesion.php'; // Redirigir a inicio_sesion.php
                    break;
            }

            changeContent(newContent); // Cambiar el contenido de div3
        });
    });

    // Mostrar automáticamente "Gestión de empleados" al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        const defaultContent = `
            <h2>Formulario de Registro</h2>
            <div class="separator-line"></div>
            <div class="form-container">
                <h3 style="text-align: center;">Usuario</h3>
                <input type="text" id="username" placeholder="Usuario" class="nunito-unique-200" oninput="saveFormData()">
                
                <h3 style="text-align: center;">Contraseña</h3>
                <div class="password-container">
                    <input type="password" id="password" placeholder="Contraseña" oninput="saveFormData()">
                    <i class="fas fa-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                </div>
                
                <h3 style="text-align: center;">Rol</h3>
                <select id="role" class="nunito-unique-200" onchange="saveFormData()">
                    <option>-- Seleccione un rol --</option>
                    <option>Admin</option>
                    <option>Empleado</option>
                </select>
                
                <button type="submit" class="nunito-unique-600">Registrar</button>
            </div>
        `;
        changeContent(defaultContent); // Mostrar automáticamente "Gestión de empleados"
    });
</script>
</body>
</html>