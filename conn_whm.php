<?php
// Credenciales de acceso a WHM
$whm_host = 'tu_servidor_whm'; // Ejemplo: 'tudominio.com:2087' o '127.0.0.1'
$whm_user = 'tu_usuario_whm';
$whm_pass = 'tu_contraseña_whm';

// Datos del usuario cuya contraseña deseas cambiar
$username = 'nombre_de_usuario';
$new_password = 'nueva_contraseña';

// URL de la API de WHM para cambiar la contraseña de un usuario
$api_url = "https://$whm_host/json-api/passwd?api.version=1&user=$username&password=$new_password";

// Configuración de la solicitud cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . base64_encode("$whm_user:$whm_pass")));
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

// Realizar la solicitud a la API de WHM
$response = curl_exec($ch);

// Verificar si la solicitud fue exitosa
if ($response === false) {
    echo 'Error al conectarse a la API de WHM: ' . curl_error($ch);
} else {
    // Decodificar la respuesta JSON
    $result = json_decode($response, true);

    // Verificar si el cambio de contraseña fue exitoso
    if ($result && isset($result['metadata']) && $result['metadata']['result'] == 1) {
        echo 'La contraseña del usuario ' . $username . ' se cambió con éxito.';
    } else {
        echo 'Error al cambiar la contraseña del usuario ' . $username . ': ' . $result['metadata']['reason'];
    }
}

// Cerrar la sesión cURL
curl_close($ch);
?>