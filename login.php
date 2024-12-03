<?php
session_start(); // Inicia la sesión

$host = "127.0.0.1"; // Cambia esto si es necesario
$dbname = "u108962509_MB_VF";
$username = "u108962509_admin_db";
$password = "2#J*xAjs";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $pass = $_POST["password"];

        // Verificar si el usuario existe en la base de datos
        $stmt = $conn->prepare("SELECT * FROM Usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($pass, $user["password"])) {
            // Almacenar el nombre de usuario en la sesión
            $_SESSION['username'] = $user['username'];

            // Almacenar el nombre de usuario en localStorage mediante JavaScript
            echo "<script>
                    localStorage.setItem('username', '" . $user['username'] . "');
                    window.location.href = 'dashboard.html';
                  </script>";
            exit();
        } else {
            echo "Credenciales incorrectas. <a href='login.html'>Intenta de nuevo</a>";
        }
    }
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
