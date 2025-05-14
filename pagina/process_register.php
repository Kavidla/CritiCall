<?php
include 'db.php';

$nombre = $_POST['nombre'];
$gmail = $_POST['gmail'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO usuarios (nombre, gmail, contrasena) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $gmail, $contrasena);

if ($stmt->execute()) {
    echo "Usuario registrado correctamente. <a href='login.php'>Iniciar sesión</a>";
} else {
    echo "Error al registrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
