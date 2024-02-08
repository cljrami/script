<html>

<head>
    <title>Control MAquina Virtual</title>
</head>

<body>
    <h1>Cambio contraseña Usuario Maquina Virtual</h1>
    <form action="script/proccess.php" method="post">
        <p>Ingrese la dirección IP de la máquina :</p>
        <input type="text" name="ip" required>
        <p>Ingrese el nombre de usuario local:</p>
        <input type="text" name="username" required>
        <p>Ingrese la nueva contraseña:</p>
        <input type="password" name="password" required>
        <p><input type="submit" value="Cambiar"></p>
    </form>
</body>

</html>