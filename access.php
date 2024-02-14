<?php
// Función para obtener la IP del cliente
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
   
    return $ipaddress;
}

// Tu IP local (reemplaza con la tuya)
$mi_ip = '192.168.5.156';

// Obtiene la IP actual del cliente
$nueva_ip = get_client_ip();

// Verifica si la IP coincide con la tuya
if ($nueva_ip === $mi_ip) {
    // Acceso permitido
    echo 'Bienvenido a la sección restringida.';
} else {
    // Acceso denegado
    echo 'No tienes permiso para acceder a esta sección.';
}