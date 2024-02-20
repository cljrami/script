<?php

// Credenciales de autenticación para la API de WHMCS
$username = 'tu_usuario_api';
$password = 'tu_contraseña_api';
$url = 'https://tudominio.com/whmcs/includes/api.php'; // Actualiza con la URL correcta de tu instalación de WHMCS

// Parámetros de la llamada a la API para obtener los usuarios
$postData = array(
    'username' => $username,
    'password' => $password,
    'action' => 'GetClients',
    'responsetype' => 'json',
);

// Inicializar cURL para realizar la solicitud a la API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

// Ejecutar la solicitud a la API y obtener la respuesta
$response = curl_exec($ch);
if ($response === false) {
    die('Error al conectarse a la API de WHMCS: ' . curl_error($ch));
}

// Decodificar la respuesta JSON
$result = json_decode($response, true);

// Verificar si la respuesta contiene errores
if ($result['result'] != 'success') {
    die('Error al obtener los usuarios: ' . $result['message']);
}

// Obtener los datos de los usuarios
$usuarios = $result['clients']['client'];

// Mostrar los datos de los usuarios
foreach ($usuarios as $usuario) {
    echo "ID: " . $usuario['id'] . "<br>";
    echo "Nombre: " . $usuario['firstname'] . " " . $usuario['lastname'] . "<br>";
    echo "Correo Electrónico: " . $usuario['email'] . "<br>";
    echo "-----<br>";
}

// Cerrar la conexión cURL
curl_close($ch);

?>
