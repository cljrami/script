<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cambiar contraseña de usuario remoto</title>

</head>

<body>
    <h1>Cambiar contraseña de usuario remoto</h1>
    <form action="/script/proccess.php" method="post">
        <p>Usuario Admin:</p>
        <input type="text" name="admin_user" required>
        <p>Contraseña Admin:</p>
        <input type="password" name="admin_pass" required>
        <p>Dirección IP:</p>
        <input type="text" name="ip" required>
        <p>Usuario al que se le quiere cambiar la contraseña:</p>
        <input type="text" name="target_user" required>
        <p>Nueva contraseña para el usuario:</p>
        <input type="password" name="new_pass" required>
        <p><input type="submit" value="Cambiar Contraseña"></p>
    </form>
</body>

</html>


</html>