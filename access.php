<?php
// Obtener la dirección IP del cliente de manera confiable
function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (!empty($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        return $_SERVER['REMOTE_ADDR'];
    } else {
        return ''; // Si no se puede obtener una IP válida, devolver una cadena vacía
    }
}

// Lista de IPs permitidas (IPv4)
$allowed_ips = array("192.168.5.156");

// Obtener la dirección IP real del cliente
$remote_ip = getRealIP();

// Verificar si la IP del cliente está en la lista blanca de IPs permitidas
if (in_array($remote_ip, $allowed_ips)) {
    // La IP del cliente está permitida, permitir que el resto del código se ejecute

    // Aquí puedes colocar el resto de tu código
    echo "La IP del cliente está permitida: $remote_ip";
} else {
    // La IP del cliente no está en la lista blanca, negar el acceso
    echo "Acceso no autorizado para la IP del cliente: $remote_ip";
}
?>