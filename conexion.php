<?php
$conexion = new mysqli("localhost", "root", "", "criticall");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
