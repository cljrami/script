<?php
// Función para obtener la IP real del cliente de manera confiable
function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Función para obtener la IP local del servidor
function getLocalIP() {
    if (isset($_SERVER['SERVER_ADDR'])) {
        $local_ip = $_SERVER['SERVER_ADDR'];
    } else {
        $local_ip = gethostbyname(gethostname());
    }
    return $local_ip;
}

// Obtener la IP real del cliente
$remote_ip = getRealIP();

// Obtener la IP local del servidor
$local_ip = getLocalIP();

// Mostrar las direcciones IP obtenidas
echo "IP del cliente: " . $remote_ip . "<br>";
echo "IP local del servidor: " . $local_ip;
?>