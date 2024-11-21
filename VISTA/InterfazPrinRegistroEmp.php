<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
include '../conexion/conexion.php';
include '../controladores/UsuarioController.php';
include '../controladores/VehiculoController.php';
include '../controladores/FacturaController.php';

$usuarioController = new UsuarioController($conexion);
$vehiculoController = new VehiculoController($conexion);
$facturaController = new FacturaController($conexion);

$usuarios = $usuarioController->listarUsuarios();
$vehiculos = $vehiculoController->listarVehiculos();
$facturas = $facturaController->listarFacturas();
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
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200..1000&display=swap" rel="stylesheet">
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
                <a href="#" onclick="showSection('users')"><i class="fas fa-users"></i><span>Clientes</span></a>
                <a href="#" onclick="showSection('vehicles')"><i class="fas fa-car"></i><span>Vehículos</span></a>
                <a href="#" onclick="showSection('invoices')"><i class=" fas fa-file-invoice"></i><span>Facturas</span></a>
                <a href="#" onclick="logout()"><i class="fas fa-sign-out-alt"></i><span>Salir</span></a>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="div3">
            <!-- Sección de Clientes -->
            <div id="users" class="main-content">
                <h2 class="nunito-unique-600">Clientes</h2>
                <hr class="separator-line">

                <div class="search-container">
                    <input type="text" placeholder="Buscar clientes..." aria-label="Buscar clientes">
                    <button type="button" class="btn btn-primary">Buscar</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">Agregar Cliente</button>
                </div>

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
                                <h3 style="text-align: center;">Nombre</h3>
                                <input type="text" id="user-name" placeholder="Nombre" class="nunito-unique-200">

                                <h3 style="text-align: center;">Apellido</h3>
                                <input type="text" id="user-lastname" placeholder="Apellido" class="nunito-unique-200">

                                <h3 style="text-align: center;">Email</h3>
                                <input type="email" id="user-email" placeholder="Email" class="nunito-unique-200">

                                <h3 style="text-align: center;">Teléfono</h3>
                                <input type="text" id="user-phone" placeholder="Teléfono" class="nunito-unique-200">

                                <button type="button" class="nunito-unique-600" onclick="registerUser ()">Registrar</button>
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
                    <button type="button" class="btn btn-primary">Buscar</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vehicleModal">Agregar Vehículo</button>
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
                                <th>Color</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="vehicleTableBody">
                            <!-- Las filas de vehículos se agregar án aquí dinámicamente -->
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
                            <h5 class="modal-title" id="vehicleModalLabel">Formulario de Registro de Vehículo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-container">
                                <div class="mb-3">
                                    <h3 class="centered">Matrícula</h3>
                                    <input type="text" id="vehicle-plate" placeholder="Matrícula" class="nunito-unique-200" required>
                                </div>

                                <div class="mb-3">
                                    <h3 class="centered">Marca</h3>
                                    <input type="text" id="vehicle-brand" placeholder="Marca" class="nunito-unique-200" required>
                                </div>

                                <div class="mb-3">
                                    <h3 class="centered">Modelo</h3>
                                    <input type="text" id="vehicle-model" placeholder="Modelo" class="nunito-unique-200" required>
                                </div>

                                <div class="mb-3">
                                    <h3 class="centered">Color</h3>
                                    <input type="text" id="vehicle-color" placeholder="Color" class="nunito-unique-200" required>
                                </div>

                                <button type="button" class="btn btn-secondary" onclick="registerVehicle()">Registrar</button>
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
                    <button type="button" class="btn btn-primary">Buscar</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal">Agregar Factura</button>
                </div>

                <div class="table-container">
                    <h3 class="nunito-unique-600">Facturas registradas</h3>
                    <table class="invoices-table common-table">
                        <thead>
                            <tr>
                                <th>ID Factura</th>
                                <th>Placa</th>
                                <th>Usuario</th>
                                <th>H. de Entrada</th>
                                <th>H. de Salida</th>
                                <th>Valor H.</th>
                                <th>Total</th>
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
                            <h5 class="modal-title" id="invoiceModalLabel">Formulario de Registro de Factura</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label ="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-container">
                                <div class="row mb-3">
                                    <div class="col">
                                        <h3 class="centered">Placa</h3>
                                        <select id="invoice-plate-select" class="nunito-unique-200" onchange="updatePlateInput()">
                                            <option value="">Seleccione una placa</option>
                                            <!-- Las opciones de placas se agregarán aquí dinámicamente -->
                                        </select>
                                        <input type="text" id="invoice-plate-input" placeholder="O ingrese una placa" class="nunito-unique-200" oninput="updatePlateSelect()">
                                    </div>
                                    <div class="col">
                                        <h3 class="centered">Usuario</h3>
                                        <select id="invoice-user-select" class="nunito-unique-200" onchange="updateUserInput()">
                                            <option value="">Seleccione un usuario</option>
                                            <!-- Las opciones de usuarios se agregarán aquí dinámicamente -->
                                        </select>
                                        <input type="text" id="invoice-user-input" placeholder="O ingrese un usuario" class="nunito-unique-200" oninput="updateUserSelect()">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <h3 class="centered">Hora de Entrada</h3>
                                        <input type="time" id="invoice-entry-time" class="nunito-unique-200">
                                    </div>
                                    <div class="col">
                                        <h3 class="centered">Hora de Salida</h3>
                                        <input type="time" id="invoice-exit-time" class="nunito-unique-200">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <h3 class="centered">Valor Hora</h3>
                                        <input type="number" id="invoice-hour-value" placeholder="Valor por hora" class="nunito-unique-200">
                                    </div>
                                    <div class="col">
                                        <h3 class="centered">Total</h3>
                                        <input type="text" id="invoice-total" placeholder="Total" class="nunito-unique-200" readonly>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary" onclick="calculateTotal()">Calcular</button>
                                <button type="button" class="nunito-unique-600" onclick="registerInvoice()">Registrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                let users = [];
                let vehicles = [];
                let invoices = [];

                // Muestra la sección seleccionada
                function showSection(section) {
                    document.querySelectorAll('.main-content').forEach((el) => {
                        el.classList.add('hidden');
                    });
                    document.getElementById(section).classList.remove('hidden');
                }

                // Funciones para manejar usuarios
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
                    $('#userModal').modal('hide');
                }

                function updateUserTable() {
                    const userTableBody = document.getElementById('userTableBody');
                    userTableBody.innerHTML = '';

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

                function clearUserForm() {
                    document.getElementById('user-name').value = '';
                    document.getElementById('user-lastname').value = '';
                    document.getElementById('user-email').value = '';
                    document.getElementById('user-phone').value = '';
                }

                // Funciones para manejar vehículos
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
                    $('#vehicleModal').modal('hide');
                }

                function updateVehicleTable() {
                    const vehicleTableBody = document.getElementById('vehicleTableBody');
                    vehicleTableBody.innerHTML = '';

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

                function clearVehicleForm() {
                    document.getElementById('vehicle-plate').value = '';
                    document.getElementById('vehicle-brand').value = '';
                    document.getElementById('vehicle-model').value = '';
                    document.getElementById('vehicle-color').value = '';
                }

                // Funciones para manejar facturas
                function registerInvoice() {
                    const plate = document.getElementById('invoice-plate-input').value;
                    const user = document.getElementById('invoice-user-input').value;
                    const entryTime = document.getElementById('invoice-entry-time').value;
                    const exitTime = document.getElementById('invoice-exit-time').value;
                    const hourValue = parseFloat(document.getElementById('invoice-hour-value').value);

                    // Convertir la hora de entrada y salida a un objeto Date
                    const entryDateTime = new Date(`1970-01-01T${entryTime}`);
                    const exitDateTime = new Date(`1970-01-01T${exitTime}`);

                    // Calcular la diferencia en horas
                    const hoursSpent = (exitDateTime - entryDateTime) / (1000 * 60 * 60);

                    // Validar que la hora de salida sea mayor que la de entrada
                    if (hoursSpent < 0) {
                        alert("La hora de salida debe ser mayor que la hora de entrada.");
                        return;
                    }

                    // Crear un nuevo objeto de factura
                    const total = hoursSpent * hourValue;
                    const newInvoice = {
                        id: invoices.length + 1,
                        plate,
                        user,
                        entryTime,
                        exitTime,
                        hourValue,
                        total
                    };

                    invoices.push(newInvoice);
                    updateInvoiceTable();
                    clearInvoiceForm();
                    $('#invoiceModal').modal('hide'); // Cerrar el modal
                }

                function updateInvoiceTable() {
                    const invoiceTableBody = document.getElementById('invoiceTableBody');
                    invoiceTableBody.innerHTML = '';

                    invoices.forEach(invoice => {
                        const row = `<tr>
            <td>${invoice.id}</td>
            <td>${invoice.plate}</td>
            <td>${invoice.user}</td>
            <td>${invoice.entryTime}</td>
            <td>${invoice.exitTime}</td>
            <td>${invoice.hourValue}</td>
            <td>${invoice.total.toFixed(2)}</td>
            <td><button class="btn btn-warning" onclick="editInvoice(${invoice.id})"><i class="fas fa-edit"></i></button></td>
        </tr>`;
                        invoiceTableBody.innerHTML += row;
                    });
                }

                function clearInvoiceForm() {
                    document.getElementById('invoice-plate-input').value = '';
                    document.getElementById('invoice-user-input').value = '';
                    document.getElementById('invoice-entry-time').value = '';
                    document.getElementById('invoice-exit-time').value = '';
                    document.getElementById('invoice-hour-value').value = '';
                    document.getElementById('invoice-total').value = '';
                }

                // Funciones para manejar la sesión
                function logout() {
                    window.location.href = 'login.php';
                }

                // Mostrar automáticamente la sección de Clientes al cargar la página
                window.onload = function() {
                    showSection('users');
                }

                // Mostrar el nombre de usuario en la interfaz
                const storedUser  = JSON.parse(localStorage.getItem('user'));
                if (storedUser ) {
                    document.getElementById('usernameDisplay').textContent = storedUser .usuario; // Solo el nombre de usuario
                } else {
                    window.location.href = 'login.php'; // Redirigir si no hay usuario
                }

                // Funciones para manejar la entrada de placa y usuario
                function updatePlateInput() {
                    const plateSelect = document.getElementById('invoice-plate-select');
                    const plateInput = document.getElementById('invoice-plate-input');

                    if (plateSelect.value) {
                        plateInput.value = plateSelect.value;
                    }
                }

                function updatePlateSelect() {
                    document.getElementById('invoice-plate-select').value = '';
                }

                function updateUserInput() {
                    const userSelect = document.getElementById('invoice-user-select');
                    const userInput = document.getElementById('invoice-user-input');

                    if (userSelect.value) {
                        userInput.value = userSelect.value;
                    }
                }

                function updateUserSelect() {
                    document.getElementById('invoice-user-select').value = '';
                }
            </script>
        </div>
    </div>
</body>

</html>