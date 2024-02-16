<?php
// Función para obtener la IP real del cliente de manera confiable
function getRealIP() {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (!empty($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } else {
        $ip = ''; // Si no se puede obtener una IP válida, devolver una cadena vacía
    }
    return $ip;
}

// Lista de IPs permitidas (IPv4 e IPv6)
$allowed_ips = array("192.168.5.156");

// Obtener la IP remota del cliente de manera confiable
$remote_ip = getRealIP();

// Verificar si la IP remota está en la lista blanca de IPs permitidas
if (in_array($remote_ip, $allowed_ips)) {
    // La IP del cliente está permitida, permitir que el resto del código se ejecute

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir los datos del formulario HTML
        $admin_user = $_POST["admin_user"] ?? '';
        $admin_pass = $_POST["admin_pass"] ?? '';
        $ip = $_POST["ip"] ?? '';
        $target_user = $_POST["target_user"] ?? '';
        $new_pass = $_POST["new_pass"] ?? '';

        // Escapar los argumentos del shell
        $admin_user = escapeshellarg($admin_user);
        $admin_pass = escapeshellarg($admin_pass);
        $ip = escapeshellarg($ip);
        $target_user = escapeshellarg($target_user);
        $new_pass = escapeshellarg($new_pass);

        // Construir el comando de PowerShell
        $command = "powershell -Command \"";
        $command .= "\$securePass = ConvertTo-SecureString -String $admin_pass -AsPlainText -Force; ";
        $command .= "\$cred = New-Object -TypeName System.Management.Automation.PSCredential -ArgumentList $admin_user, \$securePass; ";
        $command .= "Invoke-Command -ComputerName $ip -Credential \$cred -ScriptBlock { ";
        $command .= "param(\$targetUser, \$newPass); ";
        $command .= "if(Get-LocalUser -Name \$targetUser -ErrorAction SilentlyContinue) { ";
        $command .= "Set-LocalUser -Name \$targetUser -Password (ConvertTo-SecureString -AsPlainText \$newPass -Force); ";
        $command .= "echo 'true'; ";
        $command .= "} else { echo 'false'; } ";
        $command .= "} -ArgumentList $target_user, $new_pass; ";
        $command .= "\"";

        // Ejecutar el comando de PowerShell y obtener la salida
        $output = shell_exec($command);

        // Verificar si el cambio de contraseña fue exitoso
        if (trim($output) === 'true') {
            echo '<script type="text/javascript">';
            echo 'alert("Cambio de contraseña realizado con éxito");';
            echo '</script>';
        } elseif (trim($output) === 'false') {
            echo "El usuario especificado no existe en el equipo remoto.";
        } else {
            echo "Ocurrió un error al cambiar la contraseña.";
        }
    }

} else {
    //La IP del cliente no está en la lista blanca, negar el acceso
    echo "Acceso no autorizado para la IP: $remote_ip";
}
?>