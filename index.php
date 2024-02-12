<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cambiar contraseña de usuario remoto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="mx-auto p-
        10 flex h-screen flex-col items-center justify-center">
        <div
            class="grid grid-cols-1  lg:border-2 rounded-none lg:border-black-200 mt-10 rounded p-10  hover:rounded-lg">
            <form action="/script/proccess.php" method="post">
                <img src="https://www.xhost.cl/wp-content/uploads/xhost-135x70.png" alt="Xhost" />
                <h1
                    class="tracking-tight mb-10 dark:text-white sm:text-1xl/[1.1]  font-bolder md:text-3xl/[1.1] lg:text-3xl/[1.1] text-focus-in ">
                    Cambiar
                    contraseña de usuario
                    remoto</h1>
                <div class="container mx-auto grid grid-cols-12 p-0">
                    <div class="grid col-span-12 md:col-span-6 lg:col-span-6">
                        <span class="text-gray-600">Admin</span>
                        <input type="text" name="admin_user" class="mr-2 p-4 bg-gray-200 rounded-md  
                            focus:border-2 focus:border-blue-600 focus:outline-none focus:ring-0 " required>
                    </div>
                    <div class="grid col-span-12 md:col-span-6 lg:col-span-6 text-gray-900">
                        <p class="text-lg ">Password</p>
                        <input type="password" name="admin_pass"
                            class="p-4 bg-gray-200 rounded-md focus:border-2 focus:border-blue-600 focus:outline-none focus:ring-0"
                            required>
                    </div>
                    <div class="grid col-span-12 md:col-span-12 lg:col-span-12">
                        <p class="text-lg text-gray-600">Dirección IP:</p>
                        <input type="text"
                            class="p-4 bg-gray-200 rounded-md focus:border-2 focus:border-blue-600 focus:outline-none focus:ring-0"
                            name="ip">
                    </div>

                    <div class="grid col-span-12 md:col-span-6 lg:col-span-6">
                        <p class=" text-lg text-gray-600">Usuario </p>
                        <input type="text" name="target_user"
                            class="mr-2 p-4 bg-gray-200 rounded-md focus:border-2 focus:border-blue-600 focus:outline-none focus:ring-0"
                            required>
                    </div>
                    <div class="grid col-span-12 md:col-span-6 lg:col-span-6">
                        <p class=" text-lg text-gray-600">Nueva contraseña </p>
                        <input type="password" name="new_pass"
                            class="p-4 bg-gray-200 rounded-md focus:border-2 focus:border-blue-600 focus:outline-none focus:ring-0"
                            required>
                    </div>
                </div>


                <p><input type="submit" value="Cambiar Contraseña"
                        class="mt-2 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                </p>
            </form>
        </div>
    </div>
</body>

</html>