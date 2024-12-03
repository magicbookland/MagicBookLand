<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Credenciales de conexión a la base de datos
$host = "127.0.0.1"; // O usa 127.0.0.1 si es necesario
$dbname = "u108962509_MB_VF"; // Nombre de tu base de datos
$username = "u108962509_admin_db"; // Usuario de MySQL
$password = "2#J*xAjs"; // Contraseña del usuario

try {
    // Intentar la conexión a la base de datos
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión a la base de datos exitosa.<br>";

    // Procesar el formulario de registro
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "Procesando el formulario...<br>";

        $user = $_POST["username"];
        $displayName = $_POST["display_name"];
        $email = $_POST["email"];
        $pass = $_POST["password"];

        echo "Datos recibidos: Username: $user, Display Name: $displayName, Email: $email<br>";

        // Verificar que los campos no estén vacíos
        if (empty($user) || empty($displayName) || empty($email) || empty($pass)) {
            die("Por favor completa todos los campos.<br>");
        }

        // Encriptar la contraseña
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        echo "Contraseña encriptada correctamente.<br>";

        try {
            // Insertar el usuario en la base de datos
            $stmt = $conn->prepare("INSERT INTO Usuarios (username, display_name, email, password) VALUES (?, ?, ?, ?)");
            echo "Preparando la consulta...<br>";

            if ($stmt->execute([$user, $displayName, $email, $hashed_pass])) {
                echo "Usuario registrado correctamente.<br>";
                header("Location: login.html");
            } else {
                echo "Hubo un problema al registrar el usuario.<br>";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Código de error para duplicado (UNIQUE)
                echo "El correo electrónico ya está registrado. <a href='signup.html'>Intenta con otro</a><br>";
            } else {
                echo "Error al registrar el usuario: " . $e->getMessage() . "<br>";
            }
        }
    }
} catch (PDOException $e) {
    // Mostrar error si la conexión falla
    die("Error de conexión: " . $e->getMessage());
}
?>

