<?php
$comando = "Get-ChildItem C:\Users";
$output = shell_exec("powershell.exe {$comando}");
echo "<pre>$output</pre>"; 

//<?php 
 //$contraseña ="olson";
 //$nombreUsuario ="olson";

 //$comando = "\$Password = ConvertTo-SecureString -AsPlainText '$contraseña' -Force; \$Credential = New-Object System.Management.Automation.PSCredential -ArgumentList '$nombreUsuario', \$Password; Enter-PSSession -ComputerName 192.168.5.125 -Credential \$Credential";
 //$output = shell_exec("powershell.exe {$comando}");
 //echo "
 //<h1>$output</h1>"; -->