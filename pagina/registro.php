<?php
include 'cone.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Evitar correos duplicados
    $check = $cone->prepare("SELECT id FROM usuarios WHERE gmail = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Ese correo ya está registrado');window.location='registro.html';</script>";
    } else {
        $stmt = $cone->prepare("INSERT INTO usuarios (nombre, contrasena, gmail) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $password, $email);
        if ($stmt->execute()) {
            echo "<script>alert('Registro exitoso');window.location='login.html';</script>";
        } else {
            echo "<script>alert('Error al registrar');window.location='registro.html';</script>";
        }
        $stmt->close();
    }
    $check->close();
}
?>
