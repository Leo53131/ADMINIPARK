<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_recuperarcontaseña.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Recuperar contaseña</title>
</head>
<body>
<div class="contenedor">
        <div class="box">
            <div class="encabezado">
            <h2>Recuperación de contaseña</h2>
            <h5>Escoje una nueva contraseña para tu cuenta</h5>
            </div>

        <form>
            <div class="input-group">
            <h4>contraseña nueva</h4>
            <input type="password" name="contraseña nueva" placeholder="''''''''''''''''" >
            <i class="fas fa-eye-slash" id="togglePassword"></i>
            <h4>Repetir contraseña</h4>
            <input type="password" name="repetir conyraseña" placeholder="''''''''''''''''" >
            <i class="fas fa-eye-slash" id="togglePassword"></i>
            </div>
        
            <button type="submit" class="Recuperar">Recuperar</button>
            
        </form>
        </div>
</body>
</html>