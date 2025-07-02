<?php
session_start();
include "conexion.php";

// Verificamos si el usuario está logueado o se pasa por GET
if (isset($_GET['id'])) {
    $id_usuario = intval($_GET['id']);
} elseif (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];
} else {
    die("Usuario no identificado");
}

// Verificamos si la conexión funciona
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Preparamos y ejecutamos consulta segura
$query = $conexion->prepare("SELECT nombre, imagen_perfil, banner, estrellas FROM usuarios WHERE id_usuario = ?");
if (!$query) {
    die("Error en la consulta: " . $conexion->error);
}

$query->bind_param("i", $id_usuario);
$query->execute();
$query->bind_result($nombre, $imagen_perfil, $banner, $estrellas);
$query->fetch();
$query->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="usuario.css">
</head>
<body>
    <!-- Botón para volver -->
<div class="volver-btn">
        <a href="index.php">← Volver al inicio</a>
    </div>


<!-- Banner -->
<div class="banner">
    <form action="actualizar_banner.php" method="POST" enctype="multipart/form-data">
        <img src="<?= $banner ?>" alt="Banner" class="img-banner" onclick="document.getElementById('bannerInput').click();">
        <input type="file" id="bannerInput" name="banner" style="display: none;" onchange="this.form.submit()">
        <input type="hidden" name="id" value="<?= $id_usuario ?>">
    </form>
</div>

<!-- Imagen de perfil -->
<!-- Imagen de perfil y nombre + estrellas -->
<div class="perfil">
    <img src="<?= $imagen_perfil ?>" alt="Foto de perfil" onclick="document.getElementById('perfilInput').click();">
    <form action="actualizar_perfil.php" method="POST" enctype="multipart/form-data">
        <input type="file" id="perfilInput" name="imagen" style="display: none;" onchange="this.form.submit()">
        <input type="hidden" name="id" value="<?= $id_usuario ?>">
    </form>

    <div class="perfil-info">
    <div class="nombre-estrellas">
        <h2><?= $nombre ?></h2>
        <div class="clasificacion">
            <?php
            $estrellas = floatval($estrellas);
            for ($i = 1; $i <= 5; $i++) {
                if ($estrellas >= 2) {
                    echo '<span class="estrella llena">&#9733;</span>';
                } elseif ($estrellas >= 1) {
                    echo '<span class="estrella media">&#9733;</span>';
                } else {
                    echo '<span class="estrella vacia">&#9734;</span>';
                }
                $estrellas -= 2;
            }
            ?>
        </div>
    </div>
</div>

    </div>
</div>


<!-- Historial de mensajes -->
<div class="historial">
    <h3>Historial</h3>
    <ul>
        <?php
        $mensajes = $conexion->query("SELECT contenido FROM mensajes WHERE id_usuario = $id_usuario");
        while ($msg = $mensajes->fetch_assoc()) {
            echo "<li>{$msg['contenido']}</li>";
        }
        ?>
    </ul>
</div>

</body>
</html>
