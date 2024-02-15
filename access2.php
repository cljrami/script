<?php

// Función para validar el formato de IP
function validate_ip($ip) {
  return filter_var($ip, FILTER_VALIDATE_IP);
}

// Función para obtener la IP pública
function get_public_ip() {
  $url = "https://api.ipify.org";
  $response = file_get_contents($url);
  return $response;
}

// Lista de IPs permitidas (puede ser un array o una cadena)
$allowed_ips_list = "186.156.33.131";

// Obtener la IP pública
$public_ip = get_public_ip();

// Convertir la cadena a un array si es necesario
if (is_string($allowed_ips_list)) {
  $allowed_ips = explode(",", $allowed_ips_list);
}

// Verificar si la IP pública está permitida
if (!validate_ip($public_ip) || !in_array($public_ip, $allowed_ips)) {
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


//<?php

//$url = "https://api.ipify.org";
//$response = file_get_contents($url);

//echo "Tu IP pública es: $response";