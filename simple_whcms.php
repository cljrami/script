function cambiar_contrasena($vars) {
// Aquí va el código de PowerShell
$username = "IDENTIFIER_OR_ADMIN_USERNAME";
$password = "SECRET_OR_HASHED_PASSWORD";
$securePass = ConvertTo-SecureString -String $password -AsPlainText -Force;
$cred = Get-Credential -UserName $username -Password $securePass;

// Obtener la dirección IP de la máquina remota
$ip = "192.168.5.115";

// Obtener el nombre de usuario del usuario que cambió su contraseña en WHMCS
// Puedes usar la variable $vars['userid'] que te proporciona el hook de WHMCS
$targetUser = $vars['userid'];

// Generar una nueva contraseña aleatoria y segura usando el cmdlet New-Guid
// Puedes quitar los guiones con el método Replace si quieres
$newPass = (New-Guid).Guid.Replace("-","")

// Ejecutar el comando de PowerShell para cambiar la contraseña del usuario en la máquina remota
Invoke-Command -ComputerName $ip -Credential $cred -ScriptBlock {
param($targetUser, $newPass)
Set-LocalUser -Name $targetUser -Password (ConvertTo-SecureString -AsPlainText $newPass -Force)
} -ArgumentList $targetUser, $newPass
}