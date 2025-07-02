<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CritiCall - Página de críticas</title>
    <link rel="stylesheet" href="dis.css">
    <style>
        .logout-btn {
            padding: 15px 30px;
            background-color: #c0392b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>

    <!-- Barra superior -->
    <header class="top-bar">
        <div class="logo">
            <img src="Portadas/logo.png" alt="Logo" height="70">
        </div>
        
        <div class="search-section">
            <input type="text" placeholder="Buscar películas...">
            <button>Subir Película</button>
        </div>

        <div class="auth-section" id="auth-section">
            <!-- Este contenido se completa con PHP y JS -->
        </div>
    </header>

    <!-- Imagen principal con carrusel automático -->
    <section class="highlight-slider">
        <?php
        include "conexion.php";
        $consulta = $conexion->query("SELECT * FROM peliculas ORDER BY RAND() LIMIT 4");
        while ($row = $consulta->fetch_assoc()) {
            echo '<div class="highlight-slide">
                    <img src="' . $row['imagen'] . '" class="highlight-img">
                    <div class="highlight-info">
                        <h3>' . htmlspecialchars($row['nombre']) . '</h3>
                        <p>' . htmlspecialchars($row['descripcion']) . '</p>
                        <p><strong>Género:</strong> ' . htmlspecialchars($row['genero']) . '</p>
                        <p><strong>Fecha:</strong> ' . htmlspecialchars($row['fecha']) . '</p>
                    </div>
                  </div>';
        }
        ?>
    </section>

    <!-- Sección de más películas -->
    <section class="more-movies-title">
        <h2>MAS PELICULAS</h2>
    </section>

    <!-- Slider estilo Netflix -->
    <section class="slider-container">
    <div class="slider" id="slider">
        <?php
        $consulta = $conexion->query("SELECT id_pelicula AS id, imagen FROM peliculas
                                      UNION
                                      SELECT id_serie AS id, imagen FROM series");

        while ($fila = $consulta->fetch_assoc()) {
            echo '<a href="chat.php?id=' . $fila['id'] . '">
                    <img src="' . $fila['imagen'] . '" class="slide">
                  </a>';
        }
        ?>
    </div>
</section>

    <script src="basura.js"></script>

    <script>
        const authSection = document.getElementById('auth-section');
    </script>

    <?php if (isset($_SESSION['usuario'])): ?>
       <script>
    authSection.innerHTML = `
        <div style="display: flex; align-items: center; gap: 10px;">
            <a href="usuario.php"><button class="user-btn"><?= htmlspecialchars($_SESSION['usuario']) ?></button></a>
            <form action="cerrar_sesion.php" method="POST" style="margin: 0;">
                <button type="submit" class="logout-btn">Cerrar sesión</button>
            </form>
        </div>
    `;
</script>
    <?php else: ?>
        <script>
            authSection.innerHTML = `
                <a href="login.php"><button class="login-btn">Iniciar Sesión</button></a>
                <a href="registro.php"><button class="register-btn">Registrarse</button></a>
            `;
        </script>
    <?php endif; ?>

    <script>
    let currentHighlight = 0;
    const slides = document.querySelectorAll('.highlight-slide');

    function rotateHighlight() {
        slides.forEach((slide, index) => {
            slide.style.display = (index === currentHighlight) ? 'flex' : 'none';
        });
        currentHighlight = (currentHighlight + 1) % slides.length;
    }

    rotateHighlight();
    setInterval(rotateHighlight, 10000);
    </script>

</body>
</html>