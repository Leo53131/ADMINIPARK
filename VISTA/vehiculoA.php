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
    include '../controladores/vehiculocontroller.php'; // Incluir el controlador de vehículos

    // Crear conexión a la base de datos
    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    // Verificar si la conexión fue exitosa
    if ($conexion) {
        $controller = new VehiculoController($conexion);
        $vehiculos = $controller->listarVehiculos(); // Obtener la lista de vehículos
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
            <!-- Sección de Vehículos -->
            <div id="vehicles" class="main-content">
                <h2 class="nunito-unique-600">Vehículos</h2>
                <hr class="separator-line">

                <div class="search-container">
                    <input type="text" id="vehicleSearch" placeholder="Buscar vehículos..." aria-label="Buscar vehículos">
                    <button type="button" onclick="searchVehicles()">Buscar</button>
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
            </div>
            <div class="pagination">
                <button class="nunito-unique-600">Anterior</button>
                <button class="nunito-unique-600">1</button>
                <button class="nunito-unique-600">2</button>
                <button class="nunito-unique-600">Siguiente</button>
            </div>
        </div>

        <script>
            let vehicleCount = <?php echo count($vehiculos) + 1; ?>; // Contador de vehículos
            let vehicles = <?php echo json_encode($vehiculos); ?>; // Cargar vehículos desde PHP

            function addVehicleRow(vehicle) {
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                        <td>${vehicle.idVehiculo}</td>
                        <td>${vehicle.matricula}</td>
                        <td>${vehicle.marca}</td>
                        <td>${vehicle.modelo}</td>
                        <td>
                            <i class="fas fa-edit" title="Editar" onclick="editVehicle(${vehicle.idVehiculo})"></i>
                        </td>
                    `;
                document.getElementById('vehicleTableBody').appendChild(newRow);
            }

            function showAddVehicleModal() {
                // Lógica para mostrar el modal de agregar vehículo
            }

            function searchVehicles() {
                const searchTerm = document.getElementById('vehicleSearch').value.toLowerCase();
                const rows = document.querySelectorAll('#vehicleTableBody tr');

                rows.forEach(row => {
                    const cells = row.getElementsByTagName('td');
                    const matricula = cells[1].textContent.toLowerCase();
                    if (matricula.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
            function logout() {
                    window.location.href = 'login.php';
                }

                const storedUser  = JSON.parse(localStorage.getItem('user'));
                if (storedUser ) {
                    document.getElementById('usernameDisplay').textContent = storedUser .usuario;
                } else {
                    window.location.href = 'login.php';
                }
        </script>
    </div>
    </div>
</body>

</html>