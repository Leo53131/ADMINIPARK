<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../conexion/conexion.php';
require_once '../controladores/empleadocontroller.php';

$conexionObj = new Conexion();
$conexion = $conexionObj->conectar();

if (!$conexion) {
    die("<div class='alert alert-danger'>Error al conectar a la base de datos.</div>");
}

$empleadoController = new EmpleadoController($conexion);
$empleados = $empleadoController->listarEmpleados();

// Configuración de la paginación
$empleadosPorPagina = 6;
$totalEmpleados = count($empleados);
$totalPaginas = ceil($totalEmpleados / $empleadosPorPagina);
$paginaActual = isset($_GET['pagina']) ? max(1, min($totalPaginas, intval($_GET['pagina']))) : 1;
$indiceInicio = ($paginaActual - 1) * $empleadosPorPagina;
$empleadosPaginados = array_slice($empleados, $indiceInicio, $empleadosPorPagina);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
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
                            <li><button class="dropdown-item" type="button" onclick="cerrarSesion()">Cerrar sesión</button></li>
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
                <a href="#" onclick="cerrarSesion()"><i class="fas fa-sign-out-alt"></i><span>Salir</span></a>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="div3">
            <div id="employees" class="main-content">
                <h2 class="nunito-unique-600">Empleados</h2>
                <hr class="separator-line">

                <div class="search-container">
                    <input type="text" id="employeeSearch" placeholder="Buscar empleados..." aria-label="Buscar empleados">
                    <button type="button" class="btn btn-primary" onclick="buscarEmpleados()">Buscar</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#employeeModal">Agregar Empleado</button>
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
                            <?php foreach ($empleadosPaginados as $empleado): ?>
                                <tr>
                <td><?php echo htmlspecialchars($empleado['idEmpleado']); ?></td>
                                    <td><?php echo htmlspecialchars($empleado['Nombre_Usuario']); ?></td>
                                    <td><?php echo $empleado['Contrasena'] === 'Inactivo' ? 'Inactivo' : '********'; ?></td>
                                    <td><?php echo htmlspecialchars($empleado['Rol']); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" onclick="editarEmpleado(<?php echo $empleado['idEmpleado']; ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm <?php echo $empleado['Contrasena'] !== 'Inactivo' ? 'btn-warning' : 'btn-success'; ?>" onclick="toggleEstadoEmpleado(<?php echo $empleado['idEmpleado']; ?>, '<?php echo $empleado['Contrasena']; ?>')">
                                            <i class="fas <?php echo $empleado['Contrasena'] !== 'Inactivo' ? 'fa-ban' : 'fa-check'; ?>"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    <button class="nunito-unique-600" onclick="cambiarPagina(<?php echo max(1, $paginaActual - 1); ?>)">Anterior</button>
                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <button class="nunito-unique-600 <?php echo $i === $paginaActual ? 'active' : ''; ?>" onclick="cambiarPagina(<?php echo $i; ?>)"><?php echo $i; ?></button>
                    <?php endfor; ?>
                    <button class="nunito-unique-600" onclick="cambiarPagina(<?php echo min($totalPaginas, $paginaActual + 1); ?>)">Siguiente</button>
                </div>
            </div>

            <!-- Modal para agregar/editar empleado -->
            <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="employeeModalLabel">Agregar Empleado</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="employeeForm">
                                <input type="hidden" id="employee-id">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" id="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Rol</label>
                                    <select class="form-control" id="role" required>
                                        <option value="">Seleccione un rol</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Empleado">Empleado</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="guardarEmpleado()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function buscarEmpleados() {
            const terminoBusqueda = document.getElementById('employeeSearch').value.toLowerCase();
            const filas = document.querySelectorAll('#employeeTableBody tr');
            let resultadosEncontrados = 0;

            filas.forEach(fila => {
                const texto = fila.textContent.toLowerCase();
                if (texto.includes(terminoBusqueda)) {
                    fila.style.display = '';
                    resultadosEncontrados++;
                } else {
                    fila.style.display = 'none';
                }
            });

            const paginacion = document.querySelector('.pagination');
            paginacion.style.display = terminoBusqueda ? 'none' : '';

            const mensajeNoResultados = document.getElementById('mensajeNoResultados');
            if (mensajeNoResultados) {
                mensajeNoResultados.remove();
            }
            if (resultadosEncontrados === 0) {
                const mensaje = document.createElement('p');
                mensaje.id = 'mensajeNoResultados';
                mensaje.textContent = 'No se encontraron resultados.';
                document.querySelector('.table-container').appendChild(mensaje);
            }
        }

        function editarEmpleado(id) {
            fetch(`../controladores/EmpleadoController.php?action=obtener&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('employee-id').value = data.idEmpleado;
                    document.getElementById('username').value = data.Nombre_Usuario;
                    document.getElementById('password').value = '';
                    document.getElementById('role').value = data.Rol;
                    
                    document.getElementById('employeeModalLabel').textContent = 'Editar Empleado';
                    const modal = new bootstrap.Modal(document.getElementById('employeeModal'));
                    modal.show();
                })
                .catch(error => console.error('Error:', error));
        }

        function guardarEmpleado() {
            const id = document.getElementById('employee-id').value;
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const role = document.getElementById('role').value;

            const data = {
                action: id ? 'actualizar' : 'agregar',
                id: id,
                username: username,
                password: password,
                role: role
            };

            fetch('../controladores/EmpleadoController.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(id ? 'Empleado actualizado con éxito' : 'Empleado agregado con éxito');
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Ocurrió un error al procesar la solicitud');
            });

            const modal = bootstrap.Modal.getInstance(document.getElementById('employeeModal'));
            modal.hide();
        }

        function toggleEstadoEmpleado(id, contrasenaActual) {
            const nuevaContrasena = contrasenaActual === 'Inactivo' ? 'Activo' : 'Inactivo';
            fetch('../controladores/EmpleadoController.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'toggleEstado',
                    id: id,
                    contrasena: nuevaContrasena
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Estado del empleado actualizado con éxito');
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Ocurrió un error al procesar la solicitud');
            });
        }

        function cambiarPagina(pagina) {
            window.location.href = 'empleadoA.php?pagina=' + pagina;
        }

        function cerrarSesion() {
            localStorage.removeItem('user');
            window.location.href = 'login.php';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const usuarioAlmacenado = JSON.parse(localStorage.getItem('user'));
            if (usuarioAlmacenado) {
                document.getElementById('usernameDisplay').textContent = usuarioAlmacenado.usuario;
            } else {
                window.location.href = 'login.php';
            }
        });
    </script>
</body>
</html>

