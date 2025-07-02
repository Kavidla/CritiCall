<?php
require 'conexion.php';

$nombre = $_POST['nombre'];
$gmail = $_POST['gmail'];
$usuario = $_POST['usuario'];
$contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre, gmail, contraseña, usuario, img, estrellas)
        VALUES (?, ?, ?, ?, '', 0)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssss", $nombre, $gmail, $contraseña, $usuario);

if ($stmt->execute()) {
    header("Location: login.php");
} else {
    echo "Error: " . $stmt->error;
}
