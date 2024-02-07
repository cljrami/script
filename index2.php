<?php
$passwordUser = "olson";
$user = "olson";
$comando = "\$Password = ConvertTo-SecureString -AsPlainText '$passwordUser' -Force; \$Credential = New-Object System.Management.Automation.PSCredential -ArgumentList '$user', \$Password; Enter-PSSession -ComputerName 192.168.5.125 -Credential \$Credential";
$output = shell_exec("powershell.exe \"$comando\"");
echo "
<pre>$output</pre>";