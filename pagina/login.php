<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <form action="process_login.php" method="POST">
        Nombre: <input type="text" name="nombre" required><br>
        Contraseña: <input type="password" name="contrasena" required><br>
        <input type="submit" value="Entrar">
    </form>
    <p>¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
</body>
</html>