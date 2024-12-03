<?php
$host = "localhost"; // o usa "127.0.0.1"
$dbname = "u108962509_magicbook";
$username = "u108962509_eduardo";
$password = "Vegito445"; // La contraseña que configuraste en el panel

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
