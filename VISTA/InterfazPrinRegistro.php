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
                            <i class="fas fa-user-circle"></i> <span id="usernameDisplay">Jimena Jiménez</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><button class="dropdown-item" type="button" onclick="logout()">Cerrar sesión</button></li>
                            <li><button class="dropdown-item" type="button">Configuración</button></li>
                            <li><button class="dropdown-item" type="button">Perfil</button></li>
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
                <h2 class="nunito-unique-600">Empleados</h2>
                <hr class="separator-line">

                <div class="search-container">
                    <input type="text" placeholder="Buscar empleados..." aria-label="Buscar empleados">
                    <button type="button" class="nunito-unique-600" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Agregar nuevo empleado
                    </button>
                </div>

                <div class="table-container">
                    <h3 class="nunito-unique-600">Empleados registrados</h3>
                    <p>Fecha de registro: <span id="registrationDate">16 de octubre de 2024</span></p>
                    <table class="employees-table table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Contraseña</th >
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
                            <h5 class="modal-title" id="staticBackdropLabel"><h2>Formulario de Registro de Empleado</h2></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario de Registro de Empleado -->
                            <div id="registerEmployeeForm">
                                <div class="form-container">
                                    <h3 style="text-align: center;">Usuario</h3>
                                    <input type="text" id="username" placeholder="Usuario" class="nunito-unique-200" oninput="saveFormData()">

                                    <h3 style="text-align: center;">Contr aseña</h3>
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

                                    <button type="submit" class="nunito-unique-600" onclick="registerEmployee()">Registrar</button>
                                </div>
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
                    <p>Fecha de registro: 16 de octubre de 2024</p>
                    <table class="users-table table">
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
                    <p>Fecha de registro: 16 de octubre de 2024</p>
                    <table class="vehicles-table table">
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
                    <p>Fecha de registro: 16 de octubre de 2024</p>
                    <table class="invoices-table table">
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
            let userCount = 1;
            let users = []; // Array para almacenar usuarios
            let vehicleCount = 1;
            let vehicles = []; // Array para almacenar vehículos
            let invoiceCount = 1;
            let invoices = []; // Array para almacenar facturas

            function showSection(sectionId) {
                const sections = document.querySelectorAll('.main-content');
                sections.forEach(section => section.classList.add('hidden'));
                document.getElementById(sectionId).classList.remove('hidden');
            }

            // Función para mostrar el formulario de registro
            function showRegisterForm() {
                document.getElementById('employees').classList.add('hidden'); // Ocultar la sección de empleados
                document.getElementById('registerEmployeeForm').classList.remove('hidden'); // Mostrar el formulario
            }

            // Función para registrar un nuevo empleado
            function registerEmployee() {
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                const role = document.getElementById('role').value;

                if (username && password && role) {
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
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td>${newEmployee.id}</td>
                        <td>${newEmployee.name}</td>
                        <td>******</td>
                        <td>${newEmployee.role}</td>
                        <td class="action-buttons">
                            <i class="fas fa-edit" title="Editar" onclick="editEmployee(${newEmployee.id})"></i>
                        </td>
                    `;

                    document.getElementById('employeeTableBody').appendChild(newRow);
                    employeeCount++;

                    // Limpiar el formulario
                    document.getElementById('registerEmployeeForm').classList.add('hidden'); // Ocultar el formulario
                    document.getElementById('employees').classList.remove('hidden'); // Mostrar la sección de empleados
                    document.getElementById('username').value = '';
                    document.getElementById('password').value = '';
                    document.getElementById('role').value = '-- Seleccione un rol --';
                } else {
                    alert('Por favor, complete todos los campos.');
                }
            }

            // Función para mostrar la tabla de empleados
            function showEmployeeTable() {
                const employeeTableBody = document.getElementById('employeeTableBody');
                employeeTableBody.innerHTML = ''; // Limpiar la tabla

                // Agregar cada empleado a la tabla
                employees.forEach(employee => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${employee.id}</td>
                        <td>${employee.name}</td>
                        <td>******</td>
                        <td>${employee.role}</td>
                        <td class="action-buttons">
                            <i class="fas fa-edit" title="Editar" onclick="editEmployee(${employee.id})"></i>
                        </td>
                    `;
                    employeeTableBody.appendChild(row);
                });

                // Mostrar la tabla y ocultar el formulario
                document.getElementById('employeeFormContainer').style.display = 'none';
                document.getElementById('employeeTableContainer').style.display = 'block';
            }

            // Función para editar un empleado
            function editEmployee(id) {
                const employee = employees.find(emp => emp.id === id);
                if (employee) {
                    document.getElementById('username').value = employee.name;
                    document.getElementById('password').value = employee.password; // Considera encriptar la contraseña en un entorno real
                    document.getElementById('role').value = employee.role;

                    // Ocultar la tabla y mostrar el formulario
                    document.getElementById('employeeTableContainer').style.display = 'none';
                    document.getElementById('registerEmployeeForm').classList.remove('hidden');
                }
            }

            // Agregar la funcionalidad de mostrar/ocultar contraseña
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    // Cambia el tipo de input entre 'password' y 'text '
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    // Cambia el ícono del ojo
                    this.classList.toggle('fa-eye-slash');
                    this.classList.toggle('fa-eye');
                });
            }

            function logout() {
                // Limpiar el localStorage
                localStorage.removeItem('user');

                // Redirigir a la página de inicio de sesión
                window.location.href = 'inicio_sesion.php';

                // Limpiar los campos del formulario de inicio de sesión
                const loginForm = document.getElementById('loginForm');
                if (loginForm) {
                    loginForm.reset(); // Esto limpiará todos los campos del formulario
                }
            }

            // Al cargar la página, establecer el nombre de usuario en el perfil
            document.addEventListener('DOMContentLoaded', function() {
                const storedUser  = JSON.parse(localStorage.getItem('user'));
                if (storedUser ) {
                    document.getElementById('usernameDisplay').textContent = storedUser .usuario || storedUser .nombre; // Usar 'usuario' o 'nombre' según lo que guardes
                }
            });

            // Mostrar la sección de Gestión de Empleados al cargar la página
            showSection('employees');
        </script>
    </body>

    </html>