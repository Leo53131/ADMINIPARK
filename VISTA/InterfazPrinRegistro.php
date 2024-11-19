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

            </div>

            <!-- Contenido principal -->
            <div class="div3">
                <!-- Sección de Gestión de Empleados -->
                <div id="employees" class="main-content">
                    <h2 class="nunito-unique-600">Empleados</h2>
                    <hr class="separator-line">

                    <div class="search-container">
                        <input type="text" placeholder="Buscar empleados..." aria-label="Buscar empleados">
                        <button type="button" class="btn btn-primary" onclick="searchEmployees()">Buscar</button>
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

                <!-- Sección de Usuarios -->
                <div id="users" class="main-content hidden">
                    <h2 class="nunito-unique-600">Usuarios</h2>
                    <hr class="separator-line">

                    <div class="search-container">
                        <input type="text" placeholder="Buscar usuarios..." aria-label="Buscar usuarios">
                        <button type="button" class="btn btn-primary" onclick="searchUsers()">Buscar</button>
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
                        <button type="button" class="btn btn-primary" onclick="searchVehicles()">Buscar</button>
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
                        <button type="button" class="btn btn-primary" onclick="searchInvoices()">Buscar</button>
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

                <script>
                    function searchEmployees() {
                        const input = document.querySelector('#employees .search-container input');
                        const filter = input.value.toLowerCase();
                        const rows = document.querySelectorAll('#employeeTableBody tr');
                        rows.forEach(row => {
                            const cells = row.getElementsByTagName('td');
                            const name = cells[1].textContent.toLowerCase();
                            row.style.display = name.includes(filter) ? '' : 'none';
                        });
                    }

                    function searchUsers() {
                        const input = document.querySelector('#users .search-container input');
                        const filter = input.value.toLowerCase();
                        const rows = document.querySelectorAll('#userTableBody tr');
                        rows.forEach(row => {
                            const cells = row.getElementsByTagName('td');
                            const name = cells[1].textContent.toLowerCase();
                            row.style.display = name.includes(filter) ? '' : 'none';
                        });
                    }

                    function searchVehicles() {
                        const input = document.querySelector('#vehicles .search-container input');
                        const filter = input.value.toLowerCase();
                        const rows = document.querySelectorAll('#vehicleTableBody tr');
                        rows.forEach(row => {
                            const cells = row.getElementsByTagName('td');
                            const plate = cells[1].textContent.toLowerCase();
                            row.style.display = plate.includes(filter) ? '' : 'none';
                        });
                    }

                    function searchInvoices() {
                        const input = document.querySelector('#invoices .search-container input');
                        const filter = input.value.toLowerCase();
                        const rows = document.querySelectorAll('#invoiceTableBody tr');
                        rows.forEach(row => {
                            const cells = row.getElementsByTagName('td');
                            const invoiceNumber = cells[1].textContent.toLowerCase();
                            row.style.display = invoiceNumber.includes(filter) ? '' : 'none';
                        });
                    }
                </script>
            </div>
</body>

</html>