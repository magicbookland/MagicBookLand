<?php
require_once 'vendor/autoload.php';  // Asegúrate de instalar la librería de Google con Composer

$client = new Google_Client(['client_id' => 'TU_CLIENT_ID_DE_GOOGLE']);  // Reemplaza con tu Client ID

$data = json_decode(file_get_contents('php://input'));

$id_token = $data->token; // Obtén el token desde el frontend

// Verificar el token de Google
try {
    $payload = $client->verifyIdToken($id_token);
    if ($payload) {
        // El token es válido, procesar login
        $email = $payload['email'];
        $username = $payload['name'];

        // Conectar a la base de datos
        $host = "127.0.0.1"; // Cambia esto si es necesario
        $dbname = "u108962509_magicbook";
        $username_db = "u108962509_eduardo";
        $password_db = "Vegito445";

        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username_db, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar si el usuario existe
        $stmt = $conn->prepare("SELECT * FROM Usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Almacenar el nombre de usuario en la sesión
            session_start();
            $_SESSION['username'] = $user['username'];
            echo json_encode(['status' => 'success']);
        } else {
            // Si no existe, crear el usuario
            $stmt = $conn->prepare("INSERT INTO Usuarios (email, username, password) VALUES (?, ?, ?)");
            $stmt->execute([$email, $username, 'default_password']);  // Asigna un password temporal si es necesario
            echo json_encode(['status' => 'success']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Token inválido']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error al verificar el token']);
}
?>
