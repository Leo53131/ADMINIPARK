<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Propietarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../estilos/style_InterfazPrinRegistro.css">
</head>

<body>
    <?php
    require_once '../conexion/conexion.php';
    require_once '../controladores/PropietarioController.php';

    $conexionObj = new Conexion();
    $conexion = $conexionObj->conectar();

    if ($conexion === null) {
        die("Error: No se pudo establecer la conexión a la base de datos.");
    }

    $propietarioController = new PropietarioController($conexion);
    $propietarios = $propietarioController->listarPropietarios();
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
                <a href="clienteE.php"><i class="fas fa-users"></i><span>Clientes</span></a>
                <a href="vehiculoE.php"><i class="fas fa-car"></i><span>Vehículos</span></a>
                <a href="facturaE.php"><i class="fas fa-file-invoice"></i><span>Facturas</span></a>
                <a href="#" onclick="logout()" class="logout-link"><i class="fas fa-sign-out-alt"></i><span>Salir</span></a>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="div3">
            <div id="propietarios" class="main-content">
                <h2 class="nunito-unique-600">Propietarios</h2>
                <hr class="separator-line">

                <div class="search-container">
                    <input type="text" id="propietarioSearch" placeholder="Buscar propietarios..." aria-label="Buscar propietarios">
                    <button type="button" class="btn btn-primary" onclick="searchPropietarios()">Buscar</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#propietarioModal">Agregar Propietario</button>
                </div>

                <div class="table-container">
                    <h3 class="nunito-unique-600">Propietarios registrados</h3>
                    <table class="propietarios-table common-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </ </tr>
                        </thead>
                        <tbody id="propietarioTableBody">
                            <?php foreach ($propietarios as $propietario): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($propietario['id']); ?></td>
                                    <td><?php echo htmlspecialchars($propietario['Nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($propietario['Apellido']); ?></td>
                                    <td><?php echo htmlspecialchars($propietario['Correo']); ?></td>
                                    <td>
                                        <i class="fas fa-edit" title="Editar" onclick="editPropietario(<?php echo $propietario['id']; ?>)"></i>
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

            <!-- Modal para agregar/editar propietario -->
            <div class="modal fade" id="propietarioModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="propietarioModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="propietarioModalLabel">Formulario de Propietario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="propietarioForm">
                                <input type="hidden" id="propietario-id">
                                <div class="mb-3">
                                    <label for="propietario-nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="propietario-nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="propietario-apellido" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="propietario-apellido" required>
                                </div>
                                <div class="mb-3">
                                    <label for="propietario-correo" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="propietario-correo" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchPropietarios() {
            const searchTerm = document.getElementById('propietarioSearch').value.toLowerCase();
            const rows = document.querySelectorAll('#propietarioTableBody tr');

            rows.forEach(row => {
                const nombre = row.cells[1].textContent.toLowerCase();
                const apellido = row.cells[2].textContent.toLowerCase();
                const correo = row.cells[3].textContent.toLowerCase();
                if (nombre.includes(searchTerm) || apellido.includes(searchTerm) || correo.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function editPropietario(id) {
            fetch(`../api/getPropietario.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('propietario-id').value = data.id;
                        document.getElementById('propietario-nombre').value = data.Nombre;
                        document.getElementById('propietario-apellido').value = data.Apellido;
                        document.getElementById('propietario-correo').value = data.Correo;
                        document.getElementById('propietarioModalLabel').textContent = 'Editar Propietario';
                        const modal = new bootstrap.Modal(document.getElementById('propietarioModal'));
                        modal.show();
                    }
                });
        }

        document.getElementById('propietarioForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('propietario-id').value;
            const nombre = document.getElementById('propietario-nombre').value;
            const apellido = document.getElementById('propietario-apellido').value;
            const correo = document.getElementById('propietario-correo').value;

            let url = id ? `../api/updatePropietario.php` : `../api/addPropietario.php`;
            let method = id ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id, nombre, apellido, correo })
            })
            .then(response => response.json())
            .then(data => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('propietarioModal'));
                modal.hide();
                location.reload(); // Recargar la página para mostrar los cambios
            });
        });

        // Mostrar el nombre de usuario en la interfaz
        const storedUser  = JSON.parse(localStorage.getItem('user'));
        if (storedUser ) {
            document.getElementById('usernameDisplay').textContent = storedUser .usuario;
        } else {
            window.location.href = 'login.php';
        }

        function logout() {
                    window.location.href = 'login.php';
                }

                
    </script>
</body>

</html>