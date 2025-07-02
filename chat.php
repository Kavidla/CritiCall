<?php
session_start();
require 'conexion.php';

if (!isset($_GET['id'])) {
    die("Película no especificada.");
}

$id = intval($_GET['id']);

// Obtener datos de la película
$consulta = $conexion->prepare("SELECT nombre, descripcion, genero, fecha, imagen FROM peliculas WHERE id_pelicula = ?");
$consulta->bind_param("i", $id);
$consulta->execute();
$consulta->bind_result($nombre, $descripcion, $genero, $fecha, $imagen);
$consulta->fetch();
$consulta->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($nombre) ?> - CritiCall</title>
    <link rel="stylesheet" href="chat.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 20px;
        }
        .back-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #3498db;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .container {
            display: flex;
            gap: 20px;
            margin-top: 50px;
        }
        .poster {
            width: 200px;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        .details {
            max-width: 600px;
        }
        .details h2 {
            margin-bottom: 10px;
        }
        .messages, .formulario {
            max-width: 800px;
            margin-top: 30px;
        }
        .messages ul {
            list-style: none;
            padding-left: 0;
        }
        .messages li {
            background-color: #e3e3e3;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 6px;
        }
        textarea {
            width: 100%;
            height: 80px;
            padding: 10px;
        }
        button {
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<a class="back-btn" href="index.php">← Volver</a>

<div class="container">
    <img src="<?= htmlspecialchars($imagen) ?>" alt="<?= htmlspecialchars($nombre) ?>" class="poster">
    <div class="details">
        <h2><?= htmlspecialchars($nombre) ?></h2>
        <p><strong>Género:</strong> <?= htmlspecialchars($genero) ?></p>
        <p><strong>Fecha:</strong> <?= htmlspecialchars($fecha) ?></p>
        <p><?= nl2br(htmlspecialchars($descripcion)) ?></p>
    </div>
</div>

<div class="messages">
    <h3>Comentarios</h3>
    <ul>
        <?php
        $sql = "SELECT u.nombre, m.contenido 
                FROM mensajes m 
                JOIN usuarios u ON m.id_usuario = u.id_usuario 
                WHERE m.id_pelicula = ?
                ORDER BY m.id_mensaje DESC";

        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($fila = $result->fetch_assoc()) {
                echo "<li><strong>" . htmlspecialchars($fila['nombre']) . ":</strong> " . htmlspecialchars($fila['contenido']) . "</li>";
            }

            $stmt->close();
        } else {
            echo "<li>Error al cargar mensajes.</li>";
        }
        ?>
    </ul>
</div>

<?php if (isset($_SESSION['id_usuario'])): ?>
    <div class="formulario">
        <form action="guardar_mensaje.php" method="POST">
            <input type="hidden" name="id_pelicula" value="<?= $id ?>">
            <textarea name="contenido" placeholder="Escribe tu comentario..." required></textarea>
            <button type="submit">Enviar</button>
        </form>
    </div>
<?php else: ?>
    <p>Para comentar, <a href="login.php">inicia sesión</a>.</p>
<?php endif; ?>

</body>
</html>