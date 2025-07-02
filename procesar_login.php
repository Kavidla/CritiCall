<?php
session_start();
require 'conexion.php';

$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $user = $resultado->fetch_assoc();
    
    if (password_verify($contraseña, $user['contraseña'])) {
        // Guardar datos del usuario en la sesión
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['id_usuario'] = $user['id_usuario']; // AÑADIDO

        header("Location: index.php"); // Redirigir al inicio o página protegida
        exit();
    } else {
        header("Location: login.php?error=Contraseña incorrecta");
        exit();
    }
} else {
    header("Location: login.php?error=Usuario no encontrado");
    exit();
}
