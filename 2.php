<?php
// Datos de la máquina virtual
$ip_maquina_virtual = '192.168.5.125'; // Ingresa la dirección IP de la máquina virtual
$admin_user_maquina_virtual = 'olson'; // Ingresa el usuario administrador de la máquina virtual
$admin_pass_maquina_virtual = '123'; // Ingresa la contraseña del usuario administrador de la máquina virtual

// Usuario al que deseas cambiar la contraseña
$target_user_maquina_virtual = '123'; // Ingresa el nombre de usuario al que deseas cambiar la contraseña

// Verificar si se han ingresado todos los datos necesarios
if (empty($ip_maquina_virtual) || empty($admin_user_maquina_virtual) || empty($admin_pass_maquina_virtual) || empty($target_user_maquina_virtual)) {
    echo "Debe proporcionar la dirección IP de la máquina, el usuario administrador y el usuario al que desea cambiar la contraseña.";
    exit;
}

// Generar una contraseña aleatoria para el usuario
$new_pass = generateRandomPassword();

// Verificar si el usuario existe en la máquina virtual
$check_command = "powershell -Command \"if(Get-LocalUser -Name $target_user_maquina_virtual -ErrorAction SilentlyContinue) { echo 'true'; } else { echo 'false'; }\"";
$user_exists = trim(shell_exec($check_command));

// Registro de acciones
$log_entry = "[" . date('Y-m-d H:i:s') . "] ";
$log_entry .= "Intento de cambio de contraseña para el usuario $target_user_maquina_virtual. ";

if ($user_exists === 'true') {
    // Construir el comando de PowerShell para cambiar la contraseña del usuario en la máquina virtual
    $command = "powershell -Command \"";
    $command .= "\$securePass = ConvertTo-SecureString -String $admin_pass_maquina_virtual -AsPlainText -Force; ";
    $command .= "\$cred = New-Object -TypeName System.Management.Automation.PSCredential -ArgumentList $admin_user_maquina_virtual, \$securePass; ";
    $command .= "Invoke-Command -ComputerName $ip_maquina_virtual -Credential \$cred -ScriptBlock { ";
    $command .= "param(\$targetUser, \$newPass); ";
    $command .= "Set-LocalUser -Name \$targetUser -Password (ConvertTo-SecureString -AsPlainText \$newPass -Force); ";
    $command .= "} -ArgumentList $target_user_maquina_virtual, $new_pass; ";
    $command .= "\"";

    // Ejecutar el comando de PowerShell y obtener la salida
    $output = shell_exec($command);

    // Verificar si el cambio de contraseña fue exitoso
    if ($output !== null) {
        $log_entry .= "Cambio de contraseña realizado con éxito. La nueva contraseña es: $new_pass";
    } else {
        $log_entry .= "Ocurrió un error al cambiar la contraseña.";
    }
} else {
    $log_entry .= "El usuario no existe en la máquina virtual.";
}

// Escribir la entrada del log en el archivo
$log_file = fopen("logs.txt", "a");
fwrite($log_file, $log_entry . "\n");
fclose($log_file);

echo $log_entry;

// Función para generar una contraseña aleatoria
function generateRandomPassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    $charactersLength = strlen($characters);
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $charactersLength - 1)];
    }
    return $password;
}
?>
