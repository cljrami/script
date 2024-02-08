<?php
// Recibir los datos del formulario html
$ip = $_POST["ip"]; // La dirección IP de la máquina remota
$username = $_POST["username"]; // El nombre de usuario local
$password = $_POST["password"]; // La nueva contraseña

// Escapar los argumentos del shell
$ip = escapeshellarg($ip);
$username = escapeshellarg($username);
$password = escapeshellarg($password);

// Construir el comando de powershell
$command = "powershell -Command \"";
if (isset ($_POST ['buscar_pac'])) {
  $cred = Get-Credential; // Pedir las credenciales del administrador
  $session = New-PSSession -ComputerName $ip -Credential $cred; // Crear la sesión remota
}
$command .= "$cred = Get-Credential; "; 
$command .= "$session = New-PSSession -ComputerName $ip -Credential $cred; "; 
$command .= "Invoke-Command -Session $session -ScriptBlock { Set-LocalUser -Name $username -Password $password }; "; // Cambiar la contraseña de usuario
$command .= "Remove-PSSession -Session $session; "; // Cerrar la sesión remota
$command .= "\"";

// Ejecutar el comando de powershell y obtener la salida
$output = shell_exec($command);

// Mostrar la salida
echo "<pre>$output</pre>"; 
?>