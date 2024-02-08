<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cambiar contraseña de usuario remoto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex h-screen justify-content-center align-content-center flex-col">
        <h1>Cambiar contraseña de usuario remoto</h1>
        <form action="/script/proccess.php" method="post">
            <p>Usuario Admin:</p>
            <input type="text" name="admin_user"
                class="peer block  appearance-none rounded-lg border border-gray-300 bg-transparent px-2.5 pr-3 pb-2.5 pt-4 text-sm text-gray-900 focus:border-2 focus:border-blue-600 focus:outline-none focus:ring-0"
                required>
            <p>Contraseña Admin:</p>
            <input type="password" name="admin_pass"
                class="peer block  appearance-none rounded-lg border border-gray-300 bg-transparent px-2.5 pr-3 pb-2.5 pt-4 text-sm text-gray-900 focus:border-2 focus:border-blue-600 focus:outline-none focus:ring-0"
                required>
            <p>Dirección IP:</p>
            <input type="text"
                class="peer block  appearance-none rounded-lg border border-gray-300 bg-transparent px-2.5 pr-3 pb-2.5 pt-4 text-sm text-gray-900 focus:border-2 focus:border-blue-600 focus:outline-none focus:ring-0"
                name="ip"
                class="peer block  appearance-none rounded-lg border border-gray-300 bg-transparent px-2.5 pr-3 pb-2.5 pt-4 text-sm text-gray-900 focus:border-2 focus:border-blue-600 focus:outline-none focus:ring-0"
                required>
            <p>Usuario al que se le quiere cambiar la contraseña:</p>
            <input type="text" name="target_user"
                class="peer block  appearance-none rounded-lg border border-gray-300 bg-transparent px-2.5 pr-3 pb-2.5 pt-4 text-sm text-gray-900 focus:border-2 focus:border-blue-600 focus:outline-none focus:ring-0"
                required>
            <p>Nueva contraseña para el usuario:</p>
            <input type="password" name="new_pass"
                class="peer block  appearance-none rounded-lg border border-gray-300 bg-transparent px-2.5 pr-3 pb-2.5 pt-4 text-sm text-gray-900 focus:border-2 focus:border-blue-600 focus:outline-none focus:ring-0"
                required>

            <p><input type="submit" value="Cambiar Contraseña"
                    class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
            </p>
        </form>
    </div>
</body>

</html>


</html>