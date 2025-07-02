<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - CritiCall</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="login-container">
        <h2>Registro de Usuario</h2>
        <form action="procesar_registro.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre completo" required>
            <input type="email" name="gmail" placeholder="Correo electrónico" required>
            <input type="text" name="usuario" placeholder="Nombre de usuario" required>
            <input type="password" name="contraseña" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
        <div class="register-link">
            ¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a>
        </div>
    </div>
</body>
</html>
