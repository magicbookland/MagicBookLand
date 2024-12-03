<?php
session_start();

require_once 'vendor/autoload.php';

// Configura el cliente de Google
$client = new Google_Client();
$client->setClientId('TU_CLIENT_ID'); // Reemplaza con tu Client ID
$client->setClientSecret('TU_CLIENT_SECRET'); // Reemplaza con tu Client Secret
$client->setRedirectUri('https://www.tudominio.com/callback'); // Reemplaza con tu URI de redirección

// Si ya se autenticó
if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    header('Location: ' . filter_var($client->getRedirectUri(), FILTER_SANITIZE_URL));
}

// Si el acceso es exitoso, obtén los datos del usuario
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
    $oauth2 = new Google_Service_Oauth2($client);
    $userInfo = $oauth2->userinfo->get();
    
    // Muestra los datos del usuario
    echo 'Bienvenido, ' . $userInfo->name . '<br>';
    echo 'Correo: ' . $userInfo->email . '<br>';
    // Aquí podrías almacenar los datos del usuario en la base de datos si es necesario.
} else {
    header('Location: google-login.php');
    exit();
}
?>
