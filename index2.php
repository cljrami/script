<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueleto de Carga con Tailwind</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <!-- Esqueleto de Carga -->
        <div id="skeleton" class="animate-pulse space-y-4">
            <div class="bg-gray-300 h-4"></div>
            <div class="bg-gray-300 h-4 w-5/6"></div>
            <div class="bg-gray-300 h-4 w-4/6"></div>
            <div class="bg-gray-300 h-4 w-3/6"></div>
            <div class="bg-gray-300 h-4 w-2/6"></div>
        </div>
        <!-- Contenido Real (Oculto por defecto) -->
        <div id="content" class="hidden">
            <div class="">1</div>
            <div class="">2</div>
            <div class="">3</div>
            <div class="">4</div>
            <div class="">5</div>
        </div>
    </div>

    <script>
        // Simulación de tiempo de carga (puedes eliminar esto en tu aplicación real)
        setTimeout(() => {
            // Ocultar el esqueleto de carga y mostrar el contenido real
            document.getElementById('skeleton').classList.add('hidden');
            document.getElementById('content').classList.remove('hidden');
        }, 10000); // Cambia este tiempo según tus necesidades
    </script>
</body>

</html>