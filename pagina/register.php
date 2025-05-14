<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>
    <h2>Registro</h2>
    <form action="process_register.php" method="POST">
        Nombre: <input type="text" name="nombre" required><br>
        Gmail: <input type="email" name="gmail" required><br>
        Contraseña: <input type="password" name="contrasena" required><br>
        <input type="submit" value="Registrar">
    </form>
    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
</body>
</html>
