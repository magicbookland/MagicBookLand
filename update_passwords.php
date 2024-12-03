<?php
// Conexión a la base de datos
$host = "localhost";  // Cambia esto si es necesario
$dbname = "u108962509_magicbook";
$username = "u108962509_eduardo";
$password = "Vegito445";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener todas las contraseñas y encriptarlas si no están en el formato adecuado
    $stmt = $conn->query("SELECT id, password FROM Usuarios");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $password = $row['password'];

        // Verificar si la contraseña está en texto plano (si no tiene el formato de hash bcrypt)
        if (strpos($password, '$2y$') !== 0) {
            // Encriptar la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Actualizar la contraseña en la base de datos
            $updateStmt = $conn->prepare("UPDATE Usuarios SET password = ? WHERE id = ?");
            $updateStmt->execute([$hashedPassword, $id]);

            echo "Contraseña del usuario con ID $id actualizada exitosamente.<br>";
        }
    }
    echo "Actualización completada.";
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>
