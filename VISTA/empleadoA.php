<?php
require_once '../conexion/conexion.php';
require_once '../controladores/EmpleadoController.php';

session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nombreRol'] !== 'Administrador') {
    header("Location: login.php");
    exit();
}

$conexion = new Conexion();
$db = $conexion->conectar();
$empleadoController = new EmpleadoController($db);

// Pagination logic
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10;
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

$empleados = $empleadoController->listarEmpleadosPaginados($start, $perPage);
$total = $empleadoController->contarEmpleados();

$pages = ceil($total / $perPage);

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
        <!-- Header and sidebar code remains the same -->

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
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="employeeTableBody">
                            <?php foreach ($empleados as $empleado): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($empleado['idEmpleado']); ?></td>
                                    <td><?php echo htmlspecialchars($empleado['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($empleado['apellido']); ?></td>
                                    <td><?php echo htmlspecialchars($empleado['correo']); ?></td>
                                    <td><?php echo htmlspecialchars($empleado['nombreUsuario']); ?></td>
                                    <td><?php echo htmlspecialchars($empleado['nombreRol']); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" onclick="editarEmpleado(<?php echo $empleado['idEmpleado']; ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" onclick="eliminarEmpleado(<?php echo $empleado['idEmpleado']; ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    <?php for ($i = 1; $i <= $pages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" class="<?php echo $page == $i ? 'active' : ''; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>
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
                                    <label for="employee-nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="employee-nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="employee-apellido" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="employee-apellido" required>
                                </div>
                                <div class="mb-3">
                                    <label for="employee-correo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="employee-correo" required>
                                </div>
                                <div class="mb-3">
                                    <label for="employee-usuario" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" id="employee-usuario" required>
                                </div>
                                <div class="mb-3">
                                    <label for="employee-contrasena" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="employee-contrasena" required>
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
            const searchTerm = document.getElementById('employeeSearch').value.toLowerCase();
            const rows = document.querySelectorAll('#employeeTableBody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        }

        function editarEmpleado(id) {
            fetch(`../controladores/EmpleadoController.php?action=obtener&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('employee-id').value = data.idEmpleado;
                    document.getElementById('employee-nombre').value = data.nombre;
                    document.getElementById('employee-apellido').value = data.apellido;
                    document.getElementById('employee-correo').value = data.correo;
                    document.getElementById('employee-usuario').value = data.nombreUsuario;
                    document.getElementById('employee-contrasena').value = '';
                    
                    document.getElementById('employeeModalLabel').textContent = 'Editar Empleado';
                    const modal = new bootstrap.Modal(document.getElementById('employeeModal'));
                    modal.show();
                });
        }

        function guardarEmpleado() {
            const id = document.getElementById('employee-id').value;
            const nombre = document.getElementById('employee-nombre').value;
            const apellido = document.getElementById('employee-apellido').value;
            const correo = document.getElementById('employee-correo').value;
            const usuario = document.getElementById('employee-usuario').value;
            const contrasena = document.getElementById('employee-contrasena').value;

            const data = {
                id: id,
                nombre: nombre,
                apellido: apellido,
                correo: correo,
                nombreUsuario: usuario,
                contrasena: contrasena,
                rol: 'Empleado' // Automatically set role as Empleado
            };

            const url = id ? '../controladores/EmpleadoController.php?action=actualizar' : '../controladores/EmpleadoController.php?action=agregar';

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

        function eliminarEmpleado(id) {
            if (confirm('¿Está seguro de que desea eliminar este empleado?')) {
                fetch(`../controladores/EmpleadoController.php?action=eliminar&id=${id}`, {
                    method: 'POST',
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Empleado eliminado con éxito');
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
        }

        function logout() {
            window.location.href = 'login.php';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const storedUser = JSON.parse(localStorage.getItem('user'));
            if (storedUser) {
                document.getElementById('usernameDisplay').textContent = storedUser.usuario;
            } else {
                window.location.href = 'login.php';
            }
        });
    </script>
</body>
</html>

