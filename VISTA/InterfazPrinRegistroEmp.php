<?php
    include 'C:/AppServ/www/desarrollo_web/ADMINIPARK-main/ADMINIPARK/conexionBD/conexionBD.php';
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
    <title>Interfaz Principal Empleado</title>
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

        /* Estilos para los modales */
        .modal-body {
            padding: 20px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
                <a href="#" onclick="showSection('users')"><i class="fas fa-users"></i><span>Cliente</span></a>
                <a href="#" onclick="showSection('vehicles')"><i class="fas fa-car"></i><span>Vehículos</span></a>
                <a href="#" onclick="showSection('invoices')"><i class="fas fa-file-invoice"></i><span>Factura</span></a>
                <a href="#" onclick="logout()"><i class="fas fa-sign-out-alt"></i><span>Salir</span></a>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="div3">
            <!-- Sección de Clientes -->
            <div id="users" class="main-content hidden">
                <h2 class="nunito-unique-600">Clientes</h2>
                <hr class="separator-line">

                <div class="search-container">
                    <input type="text" placeholder="Buscar clientes..." aria-label="Buscar clientes">
                </div>

                <div class="table-container">
                    <h3 class="nunito-unique-600">Clientes registrados</h3>
                    <table class="users-table common-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Celular</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <!-- Las filas de clientes se agregarán aquí dinámicamente -->
                        </tbody>
                    </table>
                </div>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">Agregar Cliente</button>

                <!-- Modal para agregar nuevo cliente -->
                <div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="userModalLabel">Formulario de Registro de Cliente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-container">
                                    <h3 class="centered">Nombre</h3>
                                    <input type="text" id="user-name" placeholder="Nombre" class="nunito-unique-200">

                                    <h3 class="centered">Apellido</h3>
                                    <input type="text" id="user-lastname" placeholder="Apellido" class="nunito-unique-200">

                                    <h3 class="centered">Correo</h3>
                                    <input type="email" id="user-email" placeholder="Correo" class="nunito-unique-200">

                                    <h3 class="centered">Celular</h3>
                                    <input type="text" id="user-phone" placeholder="Celular" class="nunito-unique-200">

                                    <button type="button" class="nunito-unique-600" onclick="registerUser ()">Registrar</button>
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
                </div>

                <div class="table-container">
                    <h3 class="nunito-unique-600">Vehículos registrados</h3>
                    <table class="vehicles-table common-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Color</th>
                            </tr>
                        </thead>
                        <tbody id="vehicleTableBody">
                            <!-- Las filas de vehículos se agregarán aquí dinámicamente -->
                        </tbody>
                    </table>
                </div>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vehicleModal">Agregar Vehículo</button>

                <!-- Modal para agregar nuevo vehículo -->
                <div class="modal fade" id="vehicleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="vehicleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="vehicleModalLabel">Formulario de Registro de Vehículo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-container">
                                    <h3 class=" centered">Placa</h3>
                                    <input type="text" id="vehicle-plate" placeholder="Placa" class="nunito-unique-200">

                                    <h3 class="centered">Marca</h3>
                                    <input type="text" id="vehicle-brand" placeholder="Marca" class="nunito-unique-200">

                                    <h3 class="centered">Modelo</h3>
                                    <input type="text" id="vehicle-model" placeholder="Modelo" class="nunito-unique-200">

                                    <h3 class="centered">Color</h3>
                                    <input type="text" id="vehicle-color" placeholder="Color" class="nunito-unique-200">

                                    <button type="button" class="nunito-unique-600" onclick="registerVehicle()">Registrar</button>
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
                </div>

                <div class="table-container">
                    <h3 class="nunito-unique-600">Facturas registradas</h3>
                    <table class="invoices-table common-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceTableBody">
                            <!-- Las filas de facturas se agregarán aquí dinámicamente -->
                        </tbody>
                    </table>
                </div>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal">Agregar Factura</button>

                <!-- Modal para agregar nueva factura -->
                <div class="modal fade" id="invoiceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="invoiceModalLabel">Formulario de Registro de Factura</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-container">
                                    <h3 class="centered">Cliente</h3>
                                    <input type="text" id="invoice-client" placeholder="Cliente" class="nunito-unique-200">

                                    <h3 class="centered">Fecha</h3>
                                    <input type="date" id="invoice-date" class="nunito-unique-200">

                                    <h3 class="centered">Monto</h3>
                                    <input type="number" id="invoice-amount" placeholder="Monto" class="nunito-unique-200">

                                    <button type="button" class="nunito-unique-600" onclick="registerInvoice()">Registrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Arreglos para almacenar los datos
        let users = [];
        let vehicles = [];
        let invoices = [];

        // Función para mostrar la sección correspondiente
        function showSection(section) {
            document.querySelectorAll('.main-content').forEach((el) => {
                el.classList.add('hidden');
            });
            document.getElementById(section).classList.remove('hidden');
        }

        // Función para registrar un nuevo cliente
        function registerUser () {
            const name = document.getElementById('user-name').value;
            const lastname = document.getElementById('user-lastname').value;
            const email = document.getElementById('user-email').value;
            const phone = document.getElementById('user-phone').value;

            const newUser  = {
                id: users.length + 1,
                name,
                lastname,
                email,
                phone
            };

            users.push(newUser );
            updateUserTable();
            clearUserForm();
            $('#userModal').modal('hide'); // Cerrar el modal
        }

        // Función para actualizar la tabla de clientes
        function updateUserTable() {
            constjavascript
            userTableBody = document.getElementById('userTableBody');
            userTableBody.innerHTML = ''; // Limpiar la tabla

            users.forEach(user => {
                const row = `<tr>
                <td>${user.id}</td>
                <td>${user.name}</td>
                <td>${user.lastname}</td>
                <td>${user.email}</td>
                <td>${user.phone}</td>
            </tr>`;
                userTableBody.innerHTML += row;
            });
        }

        // Función para limpiar el formulario de cliente
        function clearUserForm() {
            document.getElementById('user-name').value = '';
            document.getElementById('user-lastname').value = '';
            document.getElementById('user-email').value = '';
            document.getElementById('user-phone').value = '';
        }

        // Función para registrar un nuevo vehículo
        function registerVehicle() {
            const plate = document.getElementById('vehicle-plate').value;
            const brand = document.getElementById('vehicle-brand').value;
            const model = document.getElementById('vehicle-model').value;
            const color = document.getElementById('vehicle-color').value;

            const newVehicle = {
                id: vehicles.length + 1,
                plate,
                brand,
                model,
                color
            };

            vehicles.push(newVehicle);
            updateVehicleTable();
            clearVehicleForm();
            $('#vehicleModal').modal('hide'); // Cerrar el modal
        }

        // Función para actualizar la tabla de vehículos
        function updateVehicleTable() {
            const vehicleTableBody = document.getElementById('vehicleTableBody');
            vehicleTableBody.innerHTML = ''; // Limpiar la tabla

            vehicles.forEach(vehicle => {
                const row = `<tr>
                <td>${vehicle.id}</td>
                <td>${vehicle.plate}</td>
                <td>${vehicle.brand}</td>
                <td>${vehicle.model}</td>
                <td>${vehicle.color}</td>
            </tr>`;
                vehicleTableBody.innerHTML += row;
            });
        }

        // Función para limpiar el formulario de vehículo
        function clearVehicleForm() {
            document.getElementById('vehicle-plate').value = '';
            document.getElementById('vehicle-brand').value = '';
            document.getElementById('vehicle-model').value = '';
            document.getElementById('vehicle-color').value = '';
        }

        // Función para registrar una nueva factura
        function registerInvoice() {
            const client = document.getElementById('invoice-client').value;
            const date = document.getElementById('invoice-date').value;
            const amount = document.getElementById('invoice-amount').value;

            const newInvoice = {
                id: invoices.length + 1,
                client,
                date,
                amount
            };

            invoices.push(newInvoice);
            updateInvoiceTable();
            clearInvoiceForm();
            $('#invoiceModal').modal('hide'); // Cerrar el modal
        }

        // Función para actualizar la tabla de facturas
        function updateInvoiceTable() {
            const invoiceTableBody = document.getElementById('invoiceTableBody');
            invoiceTableBody.innerHTML = ''; // Limpiar la tabla

            invoices.forEach(invoice => {
                const row = `<tr>
                <td>${invoice.id}</td>
                <td>${invoice.client}</td>
                <td>${invoice.date}</td>
                <td>${invoice.amount}</td>
            </tr>`;
                invoiceTableBody.innerHTML += row;
            });
        }

        // Función para limpiar el formulario de factura
        function clearInvoiceForm() {
            document.getElementById('invoice-client').value = '';
            document.getElementById('invoice-date').value = '';
            document.getElementById('invoice-amount').value = '';
        }

        // Función para cerrar sesión
        function logout() {
            // Lógica para cerrar sesión
            alert('Sesión cerrada');
        }

        // Mostrar automáticamente la sección de Clientes al cargar la página
        window.onload = function() {
            showSection('users');
        }
    </script>

</body>

</html>