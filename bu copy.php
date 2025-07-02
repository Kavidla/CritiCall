<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Slider Estilo Netflix</title>
    <link rel="stylesheet" href="buu.css">
</head>
<body>

    <section class="carousel-container">
        <button class="carousel-btn left" onclick="moveLeft()">&#10094;</button>
        <div class="carousel-track" id="carousel">
            <img src="Portadas/Alicia.jpeg" class="carousel-item">
            <img src="Portadas/Maria_antonieta.jpeg" class="carousel-item">
            <img src="Portadas/Sonic_3.jpeg" class="carousel-item">
            <img src="Portadas/Monster.jpeg" class="carousel-item">
            <img src="Portadas/Goodfellas.jpeg" class="carousel-item">
        </div>
        <button class="carousel-btn right" onclick="moveRight()">&#10095;</button>
    </section>

    <script src="slider.js"></script>
</body>
</html>
