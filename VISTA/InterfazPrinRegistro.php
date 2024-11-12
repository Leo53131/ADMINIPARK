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

        .centered {
            text-align: center;
        }

        /* Estilos comunes para todas las tablas */
        .common-table {
            width: 100%;
            max-width: 800px;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .common-table th,
        .common-table td {
            padding: 20px;
            text-align: left;
            border-bottom: 1px solid #da7e5b;
            font-size: 16px;
            min-height: 50px;
        }

        /* Encabezado de la tabla */
        .common-table th {
            background-color: #da7e5b;
            color: white;
            font-weight: bold;
        }

        /* Celdas de la tabla */
        .common-table td {
            color: #6c4a4a;
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
                <a href="#" onclick="showSection('users')"><i class="fas fa-users"></i><span>Usuarios</span></a>
                <a href="#" onclick="showSection('vehicles')"><i class="fas fa-car"></i><span>Vehículos</span></a>
                <a href="#" onclick="showSection('invoices')"><i class="fas fa-file-invoice"></i><span>Factura</span></a>
                <a href="#" onclick="logout()"><i class="fas fa-sign-out-alt"></i><span>Salir</span></a>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="div3">
            <!-- Sección de Gestión de Empleados -->
            <div id="employees" class="main-content">
                <h2 class="nunito-unique -600">Empleados</h2>
                <hr class="separator-line">

                <div class="search-container">
                    <input type="text" placeholder="Buscar empleados..." aria-label="Buscar empleados">
                    <button type="button" class="nunito-unique-600" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Agregar nuevo empleado
                    </button>
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
                            <!-- Las filas de empleados se agregarán aquí dinámicamente -->
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

            <!-- Sección de Usuarios -->
            <div id="users" class="main-content hidden">
                <h2 class="nunito-unique-600">Usuarios</h2>
                <hr class="separator-line">

                <div class="search-container">
                    <input type="text" placeholder="Buscar usuarios..." aria-label="Buscar usuarios">
                </div>

                <div class="table-container">
                    <h3 class="nunito-unique-600">Usuarios registrados</h3>
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
                        <tbody id="userTableBody">
                            <!-- Las filas de usuarios se agregarán aquí dinámicamente -->
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

            <!-- Sección de Vehículos -->
            <div id="vehicles" class="main-content hidden">
                <h2 class="nunito-unique-600">Vehículos</h2>
                <hr class="separator-line">

                <div class="search-container">
                    <input type="text" placeholder="Buscar vehículos..." aria-label="Buscar vehículos">
                </div>

                <div class="table-container">
                    <h3 class="nunito-unique-600">Vehículos registrados</h3>
                    <table class="vehicles-table common-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Matrícula</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="vehicleTableBody">
                            <!-- Las filas de vehículos se agregarán aquí dinámicamente -->
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

            <!-- Sección de Facturas -->
            <div id="invoices" class="main-content hidden">
                <h2 class="nunito-unique-600">Facturas</h2>
                <hr class="separator-line">

                <div class="search-container">
                    <input type="text" placeholder="Buscar facturas..." aria-label="Buscar facturas">
                </div>

                <div class="table-container">
                    <h3 class="nunito-unique-600">Facturas registradas</h3>
                    <table class="invoices-table common-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Número de factura</th>
                                <th>Fecha de emisión</th>
                                <th>Monto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceTableBody">
                            <!-- Las filas de facturas se agregarán aquí dinámicamente -->
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
        </div>

        <script>
            let employeeCount = 1;
            let employees = []; // Array para almacenar empleados

            function showSection(sectionId) {
                const sections = document.querySelectorAll('.main-content');
                sections.forEach(section => section.classList.add('hidden'));
                document.getElementById(sectionId).classList.remove('hidden');
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

                // Crear un nuevo empleado
                const newEmployee = {
                    id: employeeCount,
                    name: username,
                    password: password, // Considera encriptar la contraseña en un entorno real
                    role: role
                };

                // Agregar el nuevo empleado al array
                employees.push(newEmployee);

                // Crear una nueva fila en la tabla
                addEmployeeRow(newEmployee);
                employeeCount++;

                // Restablecer el formulario y cerrar el modal
                resetForm();
                const modalElement = bootstrap.Modal.getInstance(document.getElementById('staticBackdrop'));
                modalElement.hide();
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
                    document.getElementById('password').value = employee.password; // Puedes manejar la visualización de la contraseña aquí
                    document.getElementById('role').value = employee.role;

                    // Cambiar el botón de registrar a editar
                    const modalTitle = document.getElementById('staticBackdropLabel');
                    modalTitle.innerText = 'Editar Empleado';
                    const registerButton = document.querySelector('.modal-body button');
                    registerButton.setAttribute('onclick', `updateEmployee(${id})`);
                    registerButton.innerText = 'Actualizar';

                    // Mostrar el modal
                    const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                    modal.show();
                }
            }

            // Función para actualizar un empleado
            function updateEmployee(id) {
                const username = document.getElementById('username').value.trim();
                const password = document.getElementById('password').value.trim();
                const role = document.getElementById('role').value;

                // Validación de los campos
                if (username === '' || password === '' || role === '') {
                    alert('Por favor, complete todos los campos.');
                    return;
                }

                // Actualizar el empleado en el array
                const employeeIndex = employees.findIndex(emp => emp.id === id);
                if (employeeIndex !== -1) {
                    employees[employeeIndex] = {
                        id: id,
                        name: username,
                        password: password,
                        role: role
                    };

                    // Actualizar la fila en la tabla
                    const rows = document.querySelectorAll('#employeeTableBody tr');
                    rows[employeeIndex].innerHTML = `
                <td>${id}</td>
                <td>${username}</td>
                <td>******</td>
                <td>${role}</td>
                <td class="action-buttons">
                    <i class="fas fa-edit" title="Editar" onclick="editEmployee(${id})"></i>
                </td>
            `;
                }

                // Restablecer el formulario y cerrar el modal
                resetForm();
                const modalElement = bootstrap.Modal.getInstance(document.getElementById('staticBackdrop'));
                modalElement.hide();
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
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.classList.toggle('fa-eye-slash');
                    this.classList.toggle('fa-eye');
                });
            }

            // Restablecer el formulario cuando el modal se oculta
            const modalElement = document.getElementById('staticBackdrop');
            modalElement.addEventListener('hidden.bs.modal', resetForm);

            function logout() {
                // Redirigir a inicio_sesion.php
                window.location.href = 'inicio_sesion.php';
            }

            window.history.pushState(null, '', window.location.href);
            window.onpopstate = function() {
                window.history.pushState(null, '', window.location.href);
            };

            // Mostrar el nombre de usuario en la interfaz
            const storedUser = JSON.parse(localStorage.getItem('user'));
            if (storedUser) {
                document.getElementById('usernameDisplay').textContent = storedUser.usuario; // Solo el nombre de usuario
            } else {
                window.location.href = 'inicio_sesion.php'; // Redirigir si no hay usuario
            }
        </script>
    </div>
</body>

</html>