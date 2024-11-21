<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
   
</head>

<body>
    <?php
    include '../conexion/conexion.php';
    include '../controladores/empleadocontroller.php'; // Incluir el controlador de empleados
    include '../controladores/propietariocontroller.php'; // Incluir el controlador de propietarios

    // Crear conexión a la base de datos
    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    // Verificar si la conexión fue exitosa
    if ($conexion) {
        $controller = new EmpleadoController($conexion);
        $empleados = $controller->listarEmpleados(); // Obtener la lista de empleados
    } else {
        echo "<div class='alert alert-danger'>Error al conectar a la base de datos.</div>";
        exit;
    }
    ?>

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
                <a href="empleadoA.php"><i class="fas fa-user"></i><span>Gestión de empleados</span></a>
                <a href="clienteA.php"><i class="fas fa-users"></i><span>Cliente</span></a>
                <a href="vehiculoA.php"><i class="fas fa-car"></i><span>Vehículos</span></a>
                <a href="facturaA.php"><i class="fas fa-file-invoice"></i><span>Factura</span></a>
                <a href="#" onclick="logout()"><i class="fas fa-sign-out-alt"></i><span>Salir</span></a>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="div3">
            <!-- Sección de Gestión de Empleados -->
            <div id="employees" class="main-content">
                <h2 class="nunito-unique-600">Empleados</h2>
                <hr class="separator-line">

                <div class="search-container">
                    <input type="text" id="employeeSearch" placeholder="Buscar empleados..." aria-label="Buscar empleados">
                    <button type="button" class="nunito-unique-600" onclick="searchEmployees()">Buscar</button>
                    <button type="button" class="nunito-unique-600" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Agregar nuevo empleado</button>
                </div>

                <div class="table-container">
                    <h3 class="nunito-unique-600">Empleados registrados</h3>
                    <table class="employees-table common-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="employeeTableBody">
                            <?php foreach ($empleados as $empleado): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($empleado['idEmpleado']); ?></td>
                                    <td><?php echo htmlspecialchars($empleado['Nombre_Usuario']); ?></td>
                                    <td>******</td>
                                    <td><?php echo htmlspecialchars($empleado['Rol']); ?></td>
                                    <td>
                                        <i class="fas fa-edit" title="Editar" onclick="editEmployee(<?php echo $empleado['idEmpleado']; ?>)"></i>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    <button class="nunito-unique-600">Anterior</button>
                    <button class="nunito-unique-600">1</button>
                    <button class="nunito-unique-600">2</button>
                    <button class="nunito-unique-600">Siguiente</button>
                </div>
            </div>

            <!-- Modal para agregar nuevo empleado -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Formulario de Registro de Empleado</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-container">
                                <h3 style="text-align: center;">Usuario</h3>
                                <input type="text" id="username" placeholder="Usuario" class="nunito-unique-200">

                                <h3 style="text-align: center;">Contraseña</h3>
                                <div class="password-container">
                                    <input type="password" id="password" placeholder="Contraseña">
                                    <i class="fas fa-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                                </div>

                                <h3 style="text-align: center;">Rol</h3>
                                <select id="role" class="nunito-unique-200">
                                    <option value="">-- Seleccione un rol --</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Empleado">Empleado</option>
                                </select>

                                <button type="button" class="nunito-unique-600" onclick="registerEmployee()">Registrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                let employeeCount = <?php echo count($empleados) + 1; ?>; // Contador de empleados
                let employees = <?php echo json_encode($empleados); ?>; // Cargar empleados desde PHP

                function registerEmployee() {
                    const username = document.getElementById('username').value.trim();
                    const password = document.getElementById('password').value.trim();
                    const role = document.getElementById('role').value;

                    if (username === '' || password === '' || role === '') {
                        alert('Por favor, complete todos los campos.');
                        return;
                    }

                    // Enviar datos al servidor para registrar el empleado
                    fetch('../controladores/empleadocontroller.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                action: 'register',
                                username: username,
                                password: password,
                                role: role
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const newEmployee = {
                                    idEmpleado: employeeCount,
                                    Nombre_Usuario: username,
                                    Rol: role
                                };
                                employees.push(newEmployee);
                                addEmployeeRow(newEmployee);
                                employeeCount++;
                                resetForm();
                                const modalElement = bootstrap.Modal.getInstance(document.getElementById('staticBackdrop'));
                                modalElement.hide();
                            } else {
                                alert('Error al registrar el empleado: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }

                function addEmployeeRow(employee) {
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
            <td>${employee.idEmpleado}</td>
            <td>${employee.Nombre_Usuario}</td>
            <td>******</td>
            <td>${employee.Rol}</td>
            <td>
                <i class="fas fa-edit" title="Editar" onclick="editEmployee(${employee.idEmpleado})"></i>
            </td>
        `;
                    document.getElementById('employeeTableBody').appendChild(newRow);
                }

                function editEmployee(id) {
                    const employee = employees.find(emp => emp.idEmpleado === id);
                    if (employee) {
                        document.getElementById('username').value = employee.Nombre_Usuario;
                        document.getElementById('password').value = ''; // No mostrar la contraseña
                        document.getElementById('role').value = employee.Rol;

                        const modalTitle = document.getElementById('staticBackdropLabel');
                        modalTitle.innerText = 'Editar Empleado';
                        const registerButton = document.querySelector('.modal-body button');
                        registerButton.setAttribute('onclick', `updateEmployee(${id})`);
                        registerButton.innerText = 'Actualizar';

                        const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                        modal.show();
                    }
                }

                function updateEmployee(id) {
                    const username = document.getElementById('username').value.trim();
                    const password = document.getElementById('password').value.trim();
                    const role = document.getElementById('role').value;

                    if (username === '' || role === '') {
                        alert('Por favor, complete todos los campos.');
                        return;
                    }

                    fetch('../controladores/empleadocontroller.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                action: 'update',
                                id: id,
                                username: username,
                                password: password,
                                role: role
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const employeeIndex = employees.findIndex(emp => emp.idEmpleado === id);
                                if (employeeIndex !== -1) {
                                    employees[employeeIndex] = {
                                        idEmpleado: id,
                                        Nombre_Usuario: username,
                                        Rol: role
                                    };
                                    const rows = document.querySelectorAll('#employeeTableBody tr');
                                    rows[employeeIndex].innerHTML = `
                        <td>${id}</td>
                        <td>${username}</td>
                        <td>******</td>
                        <td>${role}</td>
                        <td>
                            <i class="fas fa-edit" title="Editar" onclick="editEmployee(${id})"></i>
                        </td>
                    `;
                                }
                                resetForm();
                                const modalElement = bootstrap.Modal.getInstance(document.getElementById('staticBackdrop'));
                                modalElement.hide();
                            } else {
                                alert('Error al actualizar el empleado: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }

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

                function searchEmployees() {
                    const searchTerm = document.getElementById('employeeSearch').value.toLowerCase();
                    const rows = document.querySelectorAll('#employeeTableBody tr');

                    rows.forEach(row => {
                        const cells = row.getElementsByTagName('td');
                        const name = cells[1].textContent.toLowerCase();
                        if (name.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                }
            </script>
        </div>
    </div>
</body>

</html>