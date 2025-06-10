<?php
$error = "";
include 'cone.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $stmt = $cone->prepare("SELECT contrasena FROM usuarios WHERE gmail = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hash);
            $stmt->fetch();
            if (password_verify($password, $hash)) {
                header("Location: panel.html");
                exit();
            } else {
                $error = "Correo o contraseña incorrectos.";
            }
        } else {
            $error = "Correo o contraseña incorrectos.";
        }
        $stmt->close();
    }

    if (isset($_POST['register'])) {
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $check = $cone->prepare("SELECT id FROM usuarios WHERE gmail = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Ese correo ya está registrado.";
        } else {
            $stmt = $cone->prepare("INSERT INTO usuarios (nombre, contrasena, gmail) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nombre, $password, $email);
            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Error al registrar el usuario.";
            }
            $stmt->close();
        }
        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | CritiCall</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        .tab { margin-bottom: 20px; cursor: pointer; color: #3498db; font-weight: bold; }
        .tab:hover { text-decoration: underline; }
        .form-section { display: none; }
        .form-section.active { display: block; }
    </style>
    <script>
        function showForm(formId) {
            document.getElementById("login-form").classList.remove("active");
            document.getElementById("register-form").classList.remove("active");
            document.getElementById(formId).classList.add("active");
        }
    </script>
</head>
<body>
<div class="login-container">
    <img src="pagina/Portadas/CritiCall.jpeg" alt="" class="logo">

    <div class="tab" onclick="showForm('login-form')">Iniciar sesión</div>
    <div class="tab" onclick="showForm('register-form')">Registrarse</div>

    <?php if (!empty($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <!-- Login -->
    <div id="login-form" class="form-section active">
        <h2>Iniciar sesión</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" name="login">Ingresar</button>
        </form>
    </div>

    <!-- Registro -->
    <div id="register-form" class="form-section">
        <h2>Registrarse</h2>
        <form method="POST">
            <input type="text" name="nombre" placeholder="Nombre completo" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" name="register">Registrarse</button>
        </form>
    </div>
</div>
</body>
</html>
