<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/styles_crearcuenta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Crear cuenta nueva</title>
</head>
<body>
<div class="contenedor">
    <div class="box">
        <div class="encabezado">
            <h2>Crear una cuenta nueva</h2>
            <h5>¿Ya te registraste? Inicia sesión aquí</h5>
        </div>

        <form id="registrationForm">
            <div class="input-group">
                <h4>Nombre</h4>
                <input type="text" name="Nombre" placeholder="Jimena" required>
                <h4>Apellido</h4>
                <input type="text" name="Apellido" placeholder="Jimenez" required>
                <h4>Correo</h4>
                <input type="email" name="correo" placeholder="Ejemplo@gmail.com" required>
                <h4>Usuario</h4>
                <input type="text" name="usuario" placeholder="jimena123" required>
                <h4>Contraseña</h4>
                <input type="password" name="contraseña" placeholder="*************" required>
            </div>
        
            <button type="submit" class="Registrarse">Registrarse</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar el envío del formulario

        // Obtener los valores del formulario
        const nombre = this.Nombre.value;
        const apellido = this.Apellido.value;
        const correo = this.correo.value;
        const usuario = this.usuario.value;
        const contraseña = this.contraseña.value;

        // Crear un objeto de usuario
        const newUser   = {
            nombre: nombre,
            apellido: apellido,
            correo: correo,
            usuario: usuario,
            contraseña: contraseña // En un entorno real, deberías encriptar la contraseña
        };

        // Guardar el usuario en localStorage
        localStorage.setItem('user', JSON.stringify(newUser ));

        // Redirigir a la página de inicio de sesión
        alert('Registro exitoso. Ahora puedes iniciar sesión.');
        window.location.href = 'inicio_sesion.php'; // Cambia esto a la ruta de tu página de inicio de sesión
    });
</script>
</body>
</html>