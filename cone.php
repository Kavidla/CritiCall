<?php
$host = 'localhost';
$db = 'login_app';
$user = 'root';
$pass = '';
$cone = new mysqli($host, $user, $pass, $db);

if ($cone->connect_error) {
    die('Error en la conexión: ' . $cone->connect_error);
}
?>
