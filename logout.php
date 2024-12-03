<?php
session_start();  // Inicia o continúa la sesión activa

// Eliminar todos los datos de sesión
session_unset();

// Destruye la sesión
session_destroy();

// Redirige al usuario de vuelta a la página de inicio (index.php o la que prefieras)
header('Location: index.php');
exit();
?>
