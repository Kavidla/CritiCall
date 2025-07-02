<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['id_usuario'], $_POST['id_pelicula'], $_POST['contenido'])) {
    die("Faltan datos");
}

$id_usuario = $_SESSION['id_usuario'];
$id_pelicula = intval($_POST['id_pelicula']);
$contenido = trim($_POST['contenido']);

$stmt = $conexion->prepare("INSERT INTO mensajes (id_usuario, id_pelicula, texto) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $id_usuario, $id_pelicula, $texto);
$stmt->execute();
$stmt->close();

header("Location: chat.php?id=" . $id_pelicula);
exit;