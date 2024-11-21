<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<body>
    <?php
    include '../conexion/conexion.php';
    include '../controladores/VehiculoController.php'; // Incluir el controlador de vehículos

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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vehículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../estilos/style_InterfazPrinRegistro.css">

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
                <a href="clienteE.php"><i class="fas fa-users"></i><span>Clientes</span></a>
                <a href="vehiculoE.php"><i class="fas fa-car"></i><span>Vehículos</span></a>
                <a href="facturaE.php"><i class="fas fa-file-invoice"></i><span>Facturas</span></a>
                <a href="#" onclick="logout()"><i class="fas fa-sign-out-alt"></i><span>Salir</span></a>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="div3">
            <div id="vehicles" class="main-content">
                <h2 class="nunito-unique-600">Vehículos</h2>
                <hr class="separator-line">

                <div class="search-container">
                    <input type="text" id="vehicleSearch" placeholder="Buscar vehículos..." aria-label="Buscar vehículos">
                    <button type="button" class="btn btn-primary" onclick="searchVehicles()">Buscar</button>
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
                            <?php foreach ($vehiculos as $vehiculo): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($vehiculo['id']); ?></td>
                                    <td><?php echo htmlspecialchars($vehiculo['matricula']); ?></td>
                                    <td><?php echo htmlspecialchars($vehiculo['marca']); ?></td>
                                    <td><?php echo htmlspecialchars($vehiculo['modelo']); ?></td>
                                    <td><?php echo htmlspecialchars($vehiculo['color']); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" onclick="editVehicle(<?php echo $vehiculo['id']; ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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

            <!-- Modal para agregar/editar vehículo -->
            <div class="modal fade" id="vehicleModal" tabindex="-1" aria-labelledby="vehicleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="vehicleModalLabel">Agregar Vehículo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="vehicleForm">
                                <input type="hidden" id="vehicle-id">
                                <div class="mb-3">
                                    <label for="vehicle-plate" class="form-label">Matrícula</label>
                                    <input type="text" class="form-control" id="vehicle-plate" required>
                                </div>
                                <div class="mb-3">
                                    <label for="vehicle-brand" class="form-label">Marca</label>
                                    <input type="text" class="form-control" id="vehicle-brand" required>
                                </div>
                                <div class="mb-3">
                                    <label for="vehicle-model" class="form-label">Modelo</label>
                                    <input type="text" class="form-control" id="vehicle-model" required>
                                </div>
                                <div class="mb-3">
                                    <label for="vehicle-color" class="form-label">Color</label>
                                    <input type="text" class="form-control" id="vehicle-color" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="saveVehicle()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showVehicles() {
            document.getElementById('vehicles').classList.remove('hidden');
        }

        function searchVehicles() {
            const searchTerm = document.getElementById('vehicleSearch').value.toLowerCase();
            const rows = document.querySelectorAll('#vehicleTableBody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        }

        function editVehicle(id) {
            fetch(`../controladores/VehiculoController.php?action=obtener&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('vehicle-id').value = data.id;
                    document.getElementById('vehicle-plate').value = data.matricula;
                    document.getElementById('vehicle-brand').value = data.marca;
                    document.getElementById('vehicle-model').value = data.modelo;
                    document.getElementById('vehicle-color').value = data.color;
                    
                    document.getElementById('vehicleModalLabel').textContent = 'Editar Vehículo';
                    const modal = new bootstrap.Modal(document.getElementById('vehicleModal'));
                    modal.show();
                })
                .catch(error => console.error('Error:', error));
        }

        function saveVehicle() {
            const id = document.getElementById('vehicle-id').value;
            const plate = document.getElementById('vehicle-plate').value;
            const brand = document.getElementById('vehicle-brand').value;
            const model = document.getElementById('vehicle-model').value;
            const color = document.getElementById('vehicle-color').value;

            const data = {
                id: id,
                matricula: plate,
                marca: brand,
                modelo: model,
                color: color
            };

            const url = id ? '../controladores/VehiculoController.php?action=actualizar' : '../controladores/VehiculoController.php?action=registrar';

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(id ? 'Vehículo actualizado con éxito' : 'Vehículo registrado con éxito');
                    location.reload(); // Recargar la página para mostrar los cambios
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Ocurrió un error al procesar la solicitud');
            });

            // Cerrar el modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('vehicleModal'));
            modal.hide();
        }

        function logout() {
            localStorage.removeItem('user');
            window.location.href = 'login.php';
        }

        // Verificar sesión de usuario al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const storedUser = JSON.parse(localStorage.getItem('user'));
            if (storedUser) {
                document.getElementById('usernameDisplay').textContent = storedUser.usuario;
            } else {
                window.location.href = 'login.php';
            }
            showVehicles(); // Mostrar la sección de vehículos por defecto
        });
    </script>
</body>
</html>

