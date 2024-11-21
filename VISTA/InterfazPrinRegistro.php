<?php
// Incluir la clase Conexion
require_once '../modelos/conexion.php';  // Cambia esta ruta si es necesario

// El resto de tu código
include '../modelospPropietario.php';

$conexion = new Conexion();
$controller = new PropietarioController($conexion->conectar());
$propietarios = $controller->listarPropietarios();
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Incluir controlador
require_once '../controladores/propietariocontroller.php';
$conexion = new Conexion();
$controller = new propietariocontroller($conexion->conectar());
$propietarios = $controller->listarPropietarios();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../estilos/style_InterfazPrinRegistro.css">
    <title>Interfaz Principal Admin</title>
    <style>
        .hidden {
            display: none;
        }

        .active-section {
            display: block !important;
        }

        .sidebar a {
            text-decoration: none;
            padding: 15px;
            display: flex;
            align-items: center;
            color: #333;
            font-weight: 500;
        }

        .sidebar a:hover {
            background-color: #f1f1f1;
        }

        .sidebar i {
            margin-right: 10px;
        }

        .main-content {
            padding: 20px;
        }

        .separator-line {
            margin: 20px 0;
        }

        .common-table {
            width: 100%;
            border-collapse: collapse;
        }

        .common-table th,
        .common-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .users-table th,
        .users-table td {
            text-align: center;
        }

        .table-container {
            overflow-x: auto;
        }

        .nunito-unique-600 {
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="parent">
        <!-- Encabezado de la interfaz -->
        <div class="div1">
            <div class="top-bar">
                <div class="logo-container">
                    <img src="../imagenes/Logo vistas (1).png" alt="Logo">
                </div>
                <div class="top-right">
                    <div class="notification" style="margin-right: 20px;">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="user-profile dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> <span id="usernameDisplay"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><button class="dropdown-item" type="button" onclick="window.open('../imagenes/Manual de usuario.pdf', '_blank')">Ayuda</button></li>
                            <li><button class="dropdown-item" type="button">Configuración</button></li>
                            <li><button class="dropdown-item" type="button" onclick="logout()">Cerrar sesión</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barra lateral de navegación -->
        <div class="div2">
            <div class="sidebar">
                <a href="#" onclick="showSection('employees')"><i class="fas fa-user"></i><span>Gestión de empleados</span></a>
                <a href="#" onclick="showSection('users')"><i class="fas fa-users"></i><span>Clientes</span></a>
                <a href="#" onclick="showSection('vehicles')"><i class="fas fa-car"></i><span>Vehículos</span></a>
                <a href="#" onclick="showSection('invoices')"><i class="fas fa-file-invoice"></i><span>Facturas</span></a>
                <a href="#" onclick="logout()"><i class="fas fa-sign-out-alt"></i><span>Salir</span></a>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="div3">
            <div id="employees" class="main-content">
                <h2 class="nunito-unique-600">Empleados</h2>
                <hr class="separator-line">
                <div class="table-container">
                    <h3 class="nunito-unique-600">Empleados registrados</h3>
                    <table class="common-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($propietarios as $propietario): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($propietario['id']); ?></td>
                                    <td><?php echo htmlspecialchars($propietario['Nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($propietario['Apellido']); ?></td>
                                    <td><?php echo htmlspecialchars($propietario['Correo']); ?></td>
                                    <td>
                                        <i class="fas fa-edit" title="Editar" onclick="editUser(<?php echo $propietario['id']; ?>)"></i>
                                        <i class="fas fa-trash" title="Eliminar" onclick="deleteUser(<?php echo $propietario['id']; ?>)"></i>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="users" class="main-content hidden">
                <h2 class="nunito-unique-600">Clientes</h2>
                <hr class="separator-line">
                <div class="table-container">
                    <h3 class="nunito-unique-600">Clientes registrados</h3>
                    <table class="users-table common-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($propietarios as $propietario): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($propietario['id']); ?></td>
                                    <td><?php echo htmlspecialchars($propietario['Nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($propietario['Apellido']); ?></td>
                                    <td><?php echo htmlspecialchars($propietario['Correo']); ?></td>
                                    <td>
                                        <i class="fas fa-edit" title="Editar" onclick="editUser(<?php echo $propietario['id']; ?>)"></i>
                                        <i class="fas fa-trash" title="Eliminar" onclick="deleteUser(<?php echo $propietario['id']; ?>)"></i>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="vehicles" class="main-content hidden">
                <h2 class="nunito-unique-600">Vehículos</h2>
                <hr class="separator-line">
                <div class="table-container">
                    <h3 class="nunito-unique-600">Vehículos registrados</h3>
                    <table class="common-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Cliente</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí puedes agregar los datos de los vehículos -->
                            <tr>
                                <td>1</td>
                                <td>ABC123</td>
                                <td>Toyota</td>
                                <td>Corolla</td>
                                <td>Juan Pérez</td>
                                <td>
                                    <i class="fas fa-edit" title="Editar"></i>
                                    <i class="fas fa-trash" title="Eliminar"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="invoices" class="main-content hidden">
                <h2 class="nunito-unique-600">Facturas</h2>
                <hr class="separator-line">
                <div class="table-container">
                    <h3 class="nunito-unique-600">Facturas generadas</h3>
                    <table class="common-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Vehículo</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Juan Pérez</td>
                                <td>Toyota Corolla</td>
                                <td>$200</td>
                                <td>2024-11-21</td>
                                <td>
                                    <i class="fas fa-eye" title="Ver"></i>
                                    <i class="fas fa-edit" title="Editar"></i>
                                    <i class="fas fa-trash" title="Eliminar"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.main-content');
            sections.forEach((section) => {
                section.classList.add('hidden');
            });
            const activeSection = document.getElementById(sectionId);
            activeSection.classList.remove('hidden');
        }
    </script>
</body>

</html>


        <script>
            let employeeCount = 1;
            let employees = []; // Array para almacenar empleados

            function showSection(sectionId) {
                const sections = document.querySelectorAll('.main-content');
                sections.forEach(section => section.classList.add('hidden')); // Oculta todas las secciones
                document.getElementById(sectionId).classList.remove('hidden'); // Muestra la sección seleccionada
            }

            // Función para registrar un nuevo empleado
            function registerEmployee() {
                const username = document.getElementById('username').value.trim();
                const password = document.getElementById('password').value.trim();
                const role = document.getElementById('role').value;

                // Validación de los campos
                if (username === '' || password === '' || role === '') {
                    alert('Por favor, complete todos los campos.');
                    return;
                }

                const data = new FormData();
                data.append('username', username);
                data.append('password', password);
                data.append('role', role);

                fetch('agregar_empleado.php', {
                        method: 'POST',
                        body: data
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Empleado agregado exitosamente.');
                            addEmployeeRow({
                                id: data.id,
                                name: username,
                                role: role
                            }); // Actualizar la tabla
                            employees.push({
                                id: data.id,
                                name: username,
                                role: role
                            }); // Actualizar el array
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Función para agregar una fila de empleado a la tabla
            function addEmployeeRow(employee) {
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
            <td>${employee.id}</td>
            <td>${employee.name}</td>
            <td>******</td>
            <td>${employee.role}</td>
            <td class="action-buttons">
                <i class="fas fa-edit" title="Editar" onclick="editEmployee(${employee.id})"></i>
            </td>
        `;
                document.getElementById('employeeTableBody').appendChild(newRow);
            }

            // Función para editar un empleado
            function editEmployee(id) {
                const employee = employees.find(emp => emp.id === id);
                if (employee) {
                    document.getElementById('username').value = employee.name;
                    document.getElementById('password').value = ''; // No mostrar la contraseña
                    document.getElementById('role').value = employee.role;

                    const modalTitle = document.getElementById('staticBackdropLabel');
                    modalTitle.innerText = 'Editar Empleado';
                    const registerButton = document.querySelector('.modal-body button');
                    registerButton.setAttribute('onclick', `updateEmployee(${id})`);
                    registerButton.innerText = 'Actualizar';

                    const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                    modal.show();
                }
            }

            // Función para actualizar un empleado
            function updateEmployee(id) {
                const username = document.getElementById('username').value.trim();
                const password = document.getElementById('password').value.trim();
                const role = document.getElementById('role').value;

                if (username === '' || role === '') {
                    alert('Por favor, complete todos los campos.');
                    return;
                }

                const data = new FormData();
                data.append('id', id);
                data.append('username', username);
                data.append('role', role);
                if (password) {
                    data.append('password', password); // Solo enviar si hay nueva contraseña
                }

                fetch('editar_empleado.php', {
                        method: 'POST',
                        body: data
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Empleado actualizado exitosamente.');
                            const employeeIndex = employees.findIndex(emp => emp.id === id);
                            if (employeeIndex !== -1) {
                                employees[employeeIndex] = {
                                    id,
                                    name: username,
                                    role
                                };
                                updateEmployeeRow(id, username, role); // Actualizar la tabla
                            }
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Función para actualizar la fila de empleado en la tabla
            function updateEmployeeRow(id, username, role) {
                const rows = document.querySelectorAll('#employeeTableBody tr');
                const rowIndex = Array.from(rows).findIndex(row => row.cells[0].textContent == id);
                if (rowIndex !== -1) {
                    rows[rowIndex].innerHTML = `
                <td>${id}</td>
                <td>${username}</td>
                <td>******</td>
                <td>${role}</td>
                <td class="action-buttons">
                    <i class="fas fa-edit" title="Editar" onclick="editEmployee(${id})"></i>
                </td>
            `;
                }
            }

            // Función para restablecer el formulario
            function resetForm() {
                document.getElementById('username').value = '';
                document.getElementById('password').value = '';
                document.getElementById('role').value = '';
                const modalTitle = document.getElementById('staticBackdropLabel');
                modalTitle.innerText = 'Formulario de Registro de Empleado';
                const registerButton = document.querySelector('.modal-body button');
                registerButton.setAttribute('onclick', 'registerEmployee()');
                registerButton.innerText = 'Registrar';
            }

            // Agregar la funcionalidad de mostrar/ocultar contraseña
            document.getElementById('togglePassword')?.addEventListener('click', function() {
                const passwordInput = document.getElementById('password');
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            });

            // Restablecer el formulario cuando el modal se oculta
            document.addEventListener('DOMContentLoaded', function() {
                const modalElement = document.getElementById('staticBackdrop');
                if (modalElement) {
                    modalElement.addEventListener('hidden.bs.modal', resetForm);
                } else {
                    console.error('No se encontró el elemento con ID "staticBackdrop".');
                }
            });

            function logout() {
                window.location.href = 'login.php';
            }

            window.history.pushState(null, '', window.location.href);
            window.onpopstate = function() {
                window.history.pushState(null, '', window.location.href);
            };

            const storedUser = JSON.parse(localStorage.getItem('user'));
            if (storedUser) {
                document.getElementById('usernameDisplay').textContent = storedUser.usuario;
            } else {
                window.location.href = 'login.php';
            }

            // Búsqueda de empleados
            function searchEmployees() {
                const searchTerm = document.getElementById('employeeSearch').value.toLowerCase();
                document.querySelectorAll('#employeeTableBody tr').forEach(row => {
                    const name = row.cells[1].textContent.toLowerCase();
                    row.style.display = name.includes(searchTerm) ? '' : 'none';
                });
            }
        </script>

    </div>
</body>

</html>