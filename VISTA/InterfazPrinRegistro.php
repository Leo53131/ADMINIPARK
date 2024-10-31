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
    <style>
        .hidden {
            display: none;
        }
    </style>
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
                <a href="#" onclick="showSection('employees')"><i class="fas fa-user"></i><span>Gestión de empleados</span></a>
                <a href="#" onclick="showSection('users')"><i class="fas fa-users"></i><span>Usuarios</span></a>
                <a href="#" onclick="showSection('vehicles')"><i class="fas fa-car"></i><span>Vehículos</span></a>
                <a href="#" onclick="showSection('invoices')"><i class="fas fa-file-invoice"></i><span>Factura</span></a>
                <a href="inicio_sesion.php"><i class="fas fa-sign-out-alt"></i><span>Salir</span></a>
            </div>
        </div>

        <div class="div3">
            <!-- Sección de Gestión de Empleados -->
            <div id="employees" class="main-content hidden">
                <h2 class="nunito-unique-600">Empleados</h2>
                <hr class="separator-line">
                
                <div class="search-container">
                    <input type="text" placeholder="Buscar empleados..." aria-label="Buscar empleados">
                    <button type="button" class="nunito-unique-600" onclick="showRegisterForm()">Agregar nuevo empleado</button>
                </div>

                <div class="table-container">
                    <h3 class="nunito-unique-600">Empleados registrados</h3>
                    <p>Fecha de registro: <span id="registrationDate">16 de octubre de 2024</span></p>
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

                <div id="registerEmployeeForm" class="hidden">
                    <h2>Formulario de Registro de Empleado</h2>
                    <div class="separator-line"></div>
                    <div class="form-container">
                        <h3 style="text-align: center;">Usuario</h3>
                        <input type ="text" id="username" placeholder="Usuario" class="nunito-unique-200" oninput="saveFormData()">
                        
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
                    <table class="users-table">
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
                    <table class="vehicles-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Matrícula</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
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
                    <table class="invoices-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Número de factura</th>
                                <th>Fecha de emisión</th>
                                <th>Monto</th >
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
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

            function showSection(sectionId) {
                const sections = document.querySelectorAll('.main-content');
                sections.forEach(section => section.classList.add('hidden'));
                document.getElementById(sectionId).classList.remove('hidden');
            }

            function showRegisterForm() {
                document.getElementById('registerEmployeeForm').classList.remove('hidden');
            }

            function registerEmployee() {
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                const role = document.getElementById('role').value;

                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${employeeCount}</td>
                    <td>${username}</td>
                    <td>******</td>
                    <td>${role}</td>
                    <td class="action-buttons">
                        <i class="fas fa-edit" title="Editar"></i>
                        <i class="fas fa-trash" title="Eliminar"></i>
                        <i class="fas fa-pencil-alt" title="Modificar"></i>
                    </td>
                `;

                document.getElementById('employeeTableBody').appendChild(newRow);
                employeeCount++;

                document.getElementById('registerEmployeeForm').classList.add('hidden');
                document.getElementById('username').value = '';
                document.getElementById('password').value = '';
                document.getElementById('role').value = '-- Seleccione un rol --';
            }

                    // Función para mostrar el formulario de empleado
        function showEmployeeForm() {
            document.getElementById('employeeFormContainer').style.display = 'block';
            document.getElementById('employeeTableContainer').style.display = 'none';
        }

        // Función para registrar un nuevo empleado
        function registerEmployee() {
            const name = document.getElementById('employeeName').value;
            const role = document.getElementById('employeeRole').value;

            if (name && role) {
                // Agregar el nuevo empleado al array
                employees.push({ name, role });

                // Limpiar los campos del formulario
                document.getElementById('employeeName').value = '';
                document.getElementById('employeeRole').value = '';

                // Volver a mostrar la tabla y ocultar el formulario
                showEmployeeTable();
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
                row.innerHTML = `<td>${employee.name}</td><td>${employee.role}</td>`;
                employeeTableBody.appendChild(row);
            });

            // Mostrar la tabla y ocultar el formulario
            document.getElementById('employeeFormContainer').style.display = 'none';
            document.getElementById('employeeTableContainer').style.display = 'block';
        }

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

        </script>
    </body>
</html>