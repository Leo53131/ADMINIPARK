<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../conexion/conexion.php';
require_once '../controladores/FacturaController.php';

$conexionObj = new Conexion();
$conexion = $conexionObj->conectar();

if (!$conexion) {
    die("Error de conexión: No se pudo establecer la conexión a la base de datos.");
}

$facturaController = new FacturaController($conexion);

try {
    $facturas = $facturaController->listarFacturas();
} catch (Exception $e) {
    die("Error al listar facturas: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Facturas</title>
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
            <div id="invoices" class="main-content">
                <h2>Facturas</h2>
                <hr>

                <div class="search-container mb-3">
                    <input type="text" id="invoiceSearch" class="form-control" placeholder="Buscar facturas..." aria-label="Buscar facturas">
                    <button type="button" class="btn btn-primary" onclick="searchInvoices()">Buscar</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal">Agregar Factura</button>
                </div>

                <div class="table-container">
                    <h3>Facturas registradas</h3>
                    <table class="table table-striped">
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
                            <?php foreach ($facturas as $factura): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($factura['id']); ?></td>
                                    <td><?php echo htmlspecialchars($factura['placa']); ?></td>
                                    <td><?php echo htmlspecialchars($factura['usuario']); ?></td>
                                    <td><?php echo htmlspecialchars($factura['hora_entrada']); ?></td>
                                    <td><?php echo htmlspecialchars($factura['hora_salida']); ?></td>
                                    <td><?php echo htmlspecialchars($factura['valor_hora']); ?></td>
                                    <td><?php echo htmlspecialchars($factura['total']); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" onclick="editInvoice(<?php echo $factura['id']; ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteInvoice(<?php echo $factura['id']; ?>)">
                                            <i class="fas fa-trash"></i>
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

        <!-- Modal para agregar/editar factura -->
        <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="invoiceModalLabel">Agregar Factura</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="invoiceForm">
                            <input type="hidden" id="invoice-id">
                            <div class="mb-3">
                                <label for="invoice-plate" class="form-label">Placa</label>
                                <input type="text" class="form-control" id="invoice-plate" required>
                            </div>
                            <div class="mb-3">
                                <label for="invoice-user" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="invoice-user" required>
                            </div>
                            <div class="mb-3">
                                <label for="invoice-entry-time" class="form-label">Hora de Entrada</label>
                                <input type="datetime-local" class="form-control" id="invoice-entry-time" required>
                            </div>
                            <div class="mb-3">
                                <label for="invoice-exit-time" class="form-label">Hora de Salida</label>
                                <input type="datetime-local" class="form-control" id="invoice-exit-time" required>
                            </div>
                            <div class="mb-3">
                                <label for="invoice-hour-value" class="form-label">Valor por Hora</label>
                                <input type="number" class="form-control" id="invoice-hour-value" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="saveInvoice()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchInvoices() {
            const searchTerm = document.getElementById('invoiceSearch').value.toLowerCase();
            const rows = document.querySelectorAll('#invoiceTableBody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        }

        function editInvoice(id) {
            fetch(`../controladores/facturaApi.php?action=obtener&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('invoice-id').value = data.id;
                    document.getElementById('invoice-plate').value = data.placa;
                    document.getElementById('invoice-user').value = data.usuario;
                    document.getElementById('invoice-entry-time').value = data.hora_entrada;
                    document.getElementById('invoice-exit-time').value = data.hora_salida;
                    document.getElementById('invoice-hour-value').value = data.valor_hora;
                    
                    document.getElementById('invoiceModalLabel').textContent = 'Editar Factura';
                    const modal = new bootstrap.Modal(document.getElementById('invoiceModal'));
                    modal.show();
                })
                .catch(error => console.error('Error:', error));
        }

        function saveInvoice() {
            const id = document.getElementById('invoice-id').value;
            const plate = document.getElementById('invoice-plate').value;
            const user = document.getElementById('invoice-user').value;
            const entryTime = document.getElementById('invoice-entry-time').value;
            const exitTime = document.getElementById('invoice-exit-time').value;
            const hourValue = document.getElementById('invoice-hour-value').value;

            const data = {
                id: id,
                placa: plate,
                usuario: user,
                hora_entrada: entryTime,
                hora_salida: exitTime,
                valor_hora: hourValue
            };

            const url = id ? '../controladores/facturaApi.php?action=actualizar' : '../controladores/facturaApi.php?action=registrar';

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
                    alert(id ? 'Factura actualizada con éxito' : 'Factura registrada con éxito');
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Ocurrió un error al procesar la solicitud');
            });

            const modal = bootstrap.Modal.getInstance(document.getElementById('invoiceModal'));
            modal.hide();
        }

        function deleteInvoice(id) {
            if (confirm('¿Está seguro de que desea eliminar esta factura?')) {
                fetch(`../controladores/facturaApi.php?action=eliminar&id=${id}`, {
                    method: 'POST',
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Factura eliminada con éxito');
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
            localStorage.removeItem('user');
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
        function logout() {
                    window.location.href = 'login.php';
                }
    </script>
</body>
</html>

