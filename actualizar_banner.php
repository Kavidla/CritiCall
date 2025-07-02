<?php
session_start();
include "conexion.php";

$id_usuario = $_POST['id'] ?? $_SESSION['id_usuario'];

if (isset($_FILES['banner']) && $_FILES['banner']['error'] == 0) {
    $ruta = "banners/" . basename($_FILES['banner']['name']);
    move_uploaded_file($_FILES['banner']['tmp_name'], $ruta);

    $stmt = $conexion->prepare("UPDATE usuarios SET banner = ? WHERE id_usuario = ?");
    $stmt->bind_param("si", $ruta, $id_usuario);
    $stmt->execute();
    $stmt->close();
}

header("Location: usuario.php?id=" . $id_usuario);
exit;
?>
