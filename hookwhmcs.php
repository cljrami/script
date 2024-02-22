add_hook('UserChangePassword', 1, function($vars) {

// Obtener información del usuario y la nueva contraseña desde WHMCS
$userid = $vars['userid']; // Suponiendo que 'userid' es el identificador único del usuario en WHMCS
$newPassword = $vars['password']; // Suponiendo que 'password' contiene la nueva contraseña

// Aquí puedes escribir el código para obtener el nombre de usuario y la dirección IP de la máquina remota
// Puedes acceder a la base de datos de WHMCS para obtener esta información

$remote_username = "remote_username"; // Reemplaza con el nombre de usuario en la máquina remota
$remote_ip = "remote_ip"; // Reemplaza con la dirección IP de la máquina remota

// Escapar los datos para su uso en PowerShell
$remote_username = escapeshellarg($remote_username);
$remote_ip = escapeshellarg($remote_ip);
$newPassword = escapeshellarg($newPassword);

// Construir el comando de PowerShell para cambiar la contraseña del usuario en la máquina remota
$command = "powershell -Command \"";
$command .= "\$securePass = ConvertTo-SecureString -String $newPassword -AsPlainText -Force; ";
$command .= "\$cred = New-Object -TypeName System.Management.Automation.PSCredential -ArgumentList $remote_username, \$securePass; ";
$command .= "Invoke-Command -ComputerName $remote_ip -Credential \$cred -ScriptBlock { ";
$command .= "param(\$newPass); ";
$command .= "Set-LocalUser -Name \$env:USERNAME -Password (ConvertTo-SecureString -AsPlainText \$newPass -Force); ";
$command .= "}\"";

// Ejecutar el comando de PowerShell para cambiar la contraseña del usuario en la máquina remota
shell_exec($command);
});