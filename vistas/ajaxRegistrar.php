<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Registro</h1>
        <?php if (!empty($error)): ?>
            <p class="text-red-500 text-sm mb-4"><?= $error ?></p>
        <?php endif; ?>
        <form action="index.php?accion=registrar" method="post" enctype="multipart/form-data" class="space-y-6">
            <!-- Campo de Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email" placeholder="Correo electrónico" 
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                </div>
            </div>

            <!-- Campo de Contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <div class="mt-2">
                    <input type="password" name="password" id="password" placeholder="Contraseña" 
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                </div>
            </div>

            <!-- Campo para la Imagen (Foto DNI) -->
            <div>
                <label for="fotoDNI" class="block text-sm font-medium text-gray-700">Foto DNI</label>
                <div class="mt-2">
                    <input type="file" name="fotoDNI" id="fotoDNI" accept="image/*" 
                        class="block w-full text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm cursor-pointer focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                </div>
            </div>

            <!-- Botón de Registro -->
            <div>
                <button type="submit" 
                    class="w-full bg-indigo-600 text-white font-medium py-2 px-4 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Registrar
                </button>
            </div>

            <!-- Enlace para Volver -->
            <div class="text-center">
                <a href="index.php" class="text-indigo-600 text-sm hover:underline">Volver</a>
            </div>
        </form>
    </div>
</body>
</html>
