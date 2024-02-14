<?php
// Lista de IPs permitidas
$allowed_ips = array("::1");

// Obtener la dirección IP del cliente
$client_ip = $_SERVER['REMOTE_ADDR'];

// Verificar si la IP del cliente está permitida
if (!in_array($client_ip, $allowed_ips)) {
    // Mostrar un mensaje de error si la IP no está permitida
    echo '<script type="text/javascript">';
    echo 'alert("La IP no está autorizada para realizar esta acción.");';
    echo '</script>';


    exit; // Detener la ejecución del código
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario HTML
    $admin_user = $_POST["admin_user"];
    $admin_pass = $_POST["admin_pass"];
    $ip = $_POST["ip"];
    $target_user = $_POST["target_user"];
    $new_pass = $_POST["new_pass"];

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
    $command .= "Set-LocalUser -Name \$targetUser -Password (ConvertTo-SecureString -AsPlainText \$newPass -Force); ";
    $command .= "} -ArgumentList $target_user, $new_pass; ";
    $command .= "\"";

    // Ejecutar el comando de PowerShell y obtener la salida
    $output = shell_exec($command);

    // Verificar si hay un error en la salida
    if (strpos($output, 'Error') !== false) {
        // Mostrar un mensaje de error
        echo '<script type="text/javascript">';
        echo 'alert("Error: No se pudo cambiar la contraseña.");';
        echo '</script>';
    } else {
        // Mostrar un mensaje de éxito
        echo '<script type="text/javascript">';
        echo 'alert("Cambio de contraseña realizado con éxito.");';
        echo '</script>';
    }
}



//ip:::1