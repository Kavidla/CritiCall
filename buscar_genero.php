<?php
include "conexion.php";

if (isset($_GET['genero'])) {
    $genero = $conexion->real_escape_string($_GET['genero']);
    $resultado = $conexion->query("SELECT nombre, imagen FROM peliculas WHERE genero = '$genero'");

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<div style='margin-bottom:10px; display:flex; align-items:center; gap:10px;'>";
            echo "<img src='" . $fila['imagen'] . "' alt='" . $fila['nombre'] . "' width='60' height='90' style='object-fit:cover; border-radius:4px;'>";
            echo "<span>" . $fila['nombre'] . "</span>";
            echo "</div>";
        }
    } else {
        echo "<p>No hay películas de ese género.</p>";
    }
}
?>
