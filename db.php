<?php
$host = 'localhost'; // Cambia esto si tu base de datos está en otro servidor
$db = 'magicbook_db';
$user = 'tu_usuario'; // Reemplaza con tu nombre de usuario de MySQL
$pass = 'tu_contraseña'; // Reemplaza con tu contraseña de MySQL

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
