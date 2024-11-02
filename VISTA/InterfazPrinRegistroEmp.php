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
    <title>Interfaz Principal Empleado</title>
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
                                <th>Usuario </th>
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
                            <h5 class="modal-title" id="staticBackdropLabel"><h2>Formulario de Registro de Empleado</h2></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario de Registro de Empleado -->
                            <div id="registerEmployeeForm">
                                <div class="form-container">
                                    <h3 style="text-align: center;">Usuario</h3>
                                    <input type="text" id="username" placeholder="Usuario " class="nunito-unique-200" oninput="saveFormData()">

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
                    <button type="button" class="nunito-unique-600" data-bs-toggle="modal" data-bs-target="#userModal">
                        Agregar nuevo usuario
                    </button>
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

            <!-- Modal para agregar nuevo usuario -->
            <div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userModalLabel"><h2>Formulario de Registro de Usuario</h2></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario de Registro de Usuario -->
                            <div id="registerUser Form">
                                <div class="form-container">
                                    <h3 style="text-align: center;">Nombre</h3>
                                    <input type="text" id="user-name" placeholder="Nombre" class="nunito-unique-200" oninput="saveFormData()">

                                    <h3 style="text-align: center;">Apellido</h3>
                                    <input type="text" id="user-lastname" placeholder="Apellido" class="nunito-unique-200" oninput="saveFormData()">

                                    <h3 style="text-align: center;">Email</h3>
                                    <input type="email" id="user-email" placeholder="Email" class="nunito-unique-200" oninput="saveFormData()">

                                    <button type="submit" class="nunito-unique-600" onclick="registerUser ()">Registrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Vehículos -->
            <div id="vehicles" class="main-content hidden">
                <h2 class="nunito-unique-600">Vehículos</h2>
                <hr class="separator-line">

                <div class="search-container">
                    <input type="text" placeholder="Buscar vehículos..." aria-label="Buscar vehículos">
                    <button type="button" class="nunito-unique-600" data-bs-toggle="modal" data-bs-target="#vehicleModal">
                        Agregar nuevo vehículo
                    </button>
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

            <!-- Modal para agregar nuevo vehículo -->
            <div class="modal fade" id="vehicleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="vehicleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="vehicleModalLabel"><h2>Formulario de Registro de Vehículo</h2></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario de Registro de Vehículo -->
                            <div id="registerVehicleForm">
                                <div class="form-container">
                                    <h3 style="text-align: center;">Matrícula</h3>
                                    <input type="text" id="vehicle-license" placeholder="Matrícula" class="nunito-unique-200" oninput="saveFormData()">

                                    <h3 style="text-align: center;">Marca</h3>
                                    <input type="text" id="vehicle-brand" placeholder="Marca" class="nunito-unique-200" oninput="saveFormData()">

                                    <h3 style="text-align: center;">Modelo</h3>
                                    <input type="text" id="vehicle-model" placeholder="Modelo" class="nunito-unique-200" oninput="saveFormData()">

                                    <button type="submit" class="nunito-unique-600" onclick="registerVehicle()">Registrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Facturas -->
            <div id="invoices" class="main-content hidden">
                <h2 class="nunito-unique-600">Facturas</h2>
                <hr class="separator-line">

                <div class="search-container">
                    <input type="text" placeholder="Buscar facturas..." aria-label="Buscar facturas">
                    <button type="button" class="nunito-unique-600" data-bs-toggle="modal" data-bs-target="#invoiceModal">
                        Agregar nueva factura
                    </button>
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

            <!-- Modal para agregar nueva factura -->
            <div class="modal fade" id="invoiceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="invoiceModalLabel"><h2>Formulario de Registro de Factura</h2></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario de Registro de Factura -->
                            <div id="registerInvoiceForm">
                                <div class="form-container">
                                    <h3 style="text-align: center;">Número de factura</h3>
                                    <input type="text" id="invoice-number" placeholder="Número de factura" class="nunito-unique-200" oninput="saveFormData()">

                                    <h3 style="text-align: center;">Fecha de emisión</h3>
                                    <input type="date" id="invoice-date" placeholder="Fecha de emisión" class="nunito-unique-200" oninput="saveFormData()">

                                    <h3 style="text-align: center;">Monto</h3>
                                    <input type="number" id="invoice-amount" placeholder="Monto" class="nunito-unique-200" oninput="saveFormData()">

                                    <button type="submit" class="nunito-unique-600" onclick="registerInvoice()">Registrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        password: password, // Considera encript ar la contraseña en un entorno real
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

            // Función para registrar un nuevo usuario
            function registerUser () {
                const name = document.getElementById('user-name').value;
                const lastname = document.getElementById('user-lastname').value;
                const email = document.getElementById('user-email').value;

                if (name && lastname && email) {
                    // Crear un nuevo usuario
                    const newUser = {
                        id: userCount,
                        name: name,
                        lastname: lastname,
                        email: email
                    };

                    // Agregar el nuevo usuario al array
                    users.push(newUser);

                    // Crear una nueva fila en la tabla
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td>${newUser .id}</td>
                        <td>${newUser .name}</td>
                        <td>${newUser .lastname}</td>
                        <td>${newUser .email}</td>
                        <td class="action-buttons">
                            <i class="fas fa-edit" title="Editar" onclick="editUser (${newUser .id})"></i>
                        </td>
                    `;

                    document.getElementById('userTableBody').appendChild(newRow);
                    userCount++;

                    // Limpiar el formulario
                    document.getElementById('registerUser Form').classList.add('hidden'); // Ocultar el formulario
                    document.getElementById('users').classList.remove('hidden'); // Mostrar la sección de usuarios
                    document.getElementById('user-name').value = '';
                    document.getElementById('user-lastname').value = '';
                    document.getElementById('user-email').value = '';
                } else {
                    alert('Por favor, complete todos los campos.');
                }
            }

            // Función para editar un usuario
            function editUser  (id) {
                const user = users.find(user => user.id === id);
                if (user ) {
                    document.getElementById('user-name').value = user .name;
                    document.getElementById('user-lastname').value = user .lastname;
                    document.getElementById('user-email').value = user .email;

                    // Ocultar la tabla y mostrar el formulario
                    document.getElementById('userTableContainer').style.display = 'none';
                    document.getElementById('registerUser  Form').classList.remove('hidden');
                }
            }

            // Función para registrar un nuevo vehículo
            function registerVehicle() {
                const license = document.getElementById('vehicle-license').value;
                const brand = document.getElementById('vehicle-brand').value;
                const model = document.getElementById('vehicle-model').value;

                if (license && brand && model) {
                    // Crear un nuevo vehículo
                    const newVehicle = {
                        id: vehicleCount,
                        license: license,
                        brand: brand,
                        model: model
                    };

                    // Agregar el nuevo vehículo al array
                    vehicles.push(newVehicle);

                    // Crear una nueva fila en la tabla
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td>${newVehicle.id}</td>
                        <td>${newVehicle.license}</td>
                        <td>${newVehicle.brand}</td>
                        <td>${newVehicle.model}</td>
                        <td class="action-buttons">
                            <i class="fas fa-edit" title="Editar" onclick="editVehicle(${newVehicle.id})"></i>
                        </td>
                    `;

                    document.getElementById('vehicleTableBody').appendChild(newRow);
                    vehicleCount++;

                    // Limpiar el formulario
                    document.getElementById('registerVehicleForm').classList.add('hidden'); // Ocultar el formulario
                    document.getElementById('vehicles').classList.remove('hidden'); // Mostrar la sección de vehículos
                    document.getElementById('vehicle-license').value = '';
                    document.getElementById('vehicle-brand').value = '';
                    document.getElementById('vehicle-model').value = '';
                } else {
                    alert('Por favor, complete todos los campos.');
                }
            }

            // Función para editar un vehículo
            function editVehicle(id) {
                const vehicle = vehicles.find(vehicle => vehicle.id === id);
                if (vehicle) {
                    document.getElementById('vehicle-license').value = vehicle.license;
                    document.getElementById('vehicle-brand').value = vehicle.brand;
                    document.getElementById('vehicle-model').value = vehicle.model;

                    // Ocultar la tabla y mostrar el formulario
                    document.getElementById('vehicleTableContainer').style.display = 'none';
                    document.getElementById('registerVehicleForm').classList.remove('hidden');
                }
            }

            // Función para registrar una nueva factura
            function registerInvoice() {
                const number = document.getElementById('invoice-number').value;
                const date = document.getElementById('invoice-date').value;
                const amount = document.getElementById('invoice-amount').value;

                if (number && date && amount) {
                    // Crear una nueva factura
                    const newInvoice = {
                        id: invoiceCount,
                        number: number,
                        date: date,
                        amount: amount
                    };

                    // Agregar la nueva factura al array
                    invoices.push(newInvoice);

                    // Crear una nueva fila en la tabla
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td>${newInvoice.id}</td>
                        <td>${newInvoice.number}</td>
                        <td>${newInvoice.date}</td>
                        <td>${newInvoice.amount}</td>
                        <td class="action-buttons">
                            <i class="fas fa-edit" title="Editar" onclick="editInvoice(${newInvoice.id})"></i>
                        </td>
                    `;

                    document.getElementById('invoiceTableBody').appendChild(newRow);
                    invoiceCount++;

                    // Limpiar el formulario
                    document.getElementById('registerInvoiceForm').classList.add('hidden'); // Ocultar el formulario
                    document.getElementById('invoices').classList.remove('hidden'); // Mostrar la sección de facturas
                    document.getElementById('invoice-number').value = '';
                    document.getElementById('invoice-date').value = '';
                    document.getElementById('invoice-amount').value = '';
                } else {
                    alert('Por favor, complete todos los campos.');
                }
            }

            // Función para editar una factura
            function editInvoice(id) {
                const invoice = invoices.find(invoice => invoice.id === id);
                if (invoice) {
                    document.getElementById('invoice-number').value = invoice.number;
                    document.getElementById('invoice-date').value = invoice.date;
                    document.getElementById('invoice-amount').value = invoice.amount;

                    // Ocultar la tabla y mostrar el formulario
                    document.getElementById('invoiceTableContainer').style.display = 'none';
                    document.getElementById('registerInvoiceForm').classList.remove('hidden');
                }
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