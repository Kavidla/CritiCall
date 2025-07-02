<?php
session_start();
include "conexion.php";

$id_usuario = $_POST['id'] ?? $_SESSION['id_usuario'];

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    $ruta = "imagenes_perfil/" . basename($_FILES['imagen']['name']);
    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

    $stmt = $conexion->prepare("UPDATE usuarios SET imagen_perfil = ? WHERE id_usuario = ?");
    $stmt->bind_param("si", $ruta, $id_usuario);
    $stmt->execute();
    $stmt->close();
}

header("Location: usuario.php?id=" . $id_usuario);
exit;
?>
