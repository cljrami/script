<?php

// Configuración de la URL de la API y la credencial de autenticación
$whmcsUrl = "https://clientes.xhost.cl/includes/api.php";
$auth = array(
    'identifier' => 'abc123', // Tu identificador de API
    'secret' => 'shhh-this-is-a-secret', // Tu secreto de API
);

// Parámetros de la solicitud de API
$postfields = array(
    'action' => 'GetClients', // El nombre de la acción de la API
    'limitstart' => 0, // El índice del primer registro a devolver
    'limitnum' => 25, // El número de registros a devolver
    'responsetype' => 'json', // El formato de la respuesta
);

// Inicializar el objeto cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $whmcsUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

// Establecer la cabecera de autenticación
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Basic ' . base64_encode($auth['identifier'] . ':' . $auth['secret'])
));

// Establecer los parámetros de la solicitud
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));

// Ejecutar la solicitud
$response = curl_exec($ch);
if (curl_error($ch)) {
    die('Error al conectar con la API: ' . curl_errno($ch) . ' - ' . curl_error($ch));
}
curl_close($ch);

// Decodificar la respuesta JSON
$jsonData = json_decode($response, true);

// Mostrar la respuesta
echo "<pre>";
print_r($jsonData);
echo "</pre>";
