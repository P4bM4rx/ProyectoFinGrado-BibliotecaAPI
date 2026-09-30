<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-lg">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Editar Libro</h1>
        <form name="formEditar" id="formEditar" enctype="multipart/form-data" class="space-y-6">
            <!-- Campo de Título -->
            <div>
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                <div class="mt-2">
                    <input value="<?php printf($libro->getTitulo()); ?>" type="text" name="titulo" id="titulo" placeholder="Título"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                </div>
            </div>

            <!-- Campo de Editorial -->
            <div>
                <label for="editorial" class="block text-sm font-medium text-gray-700">Editorial</label>
                <div class="mt-2">
                    <input value="<?php printf($libro->getEditorial()); ?>" type="text" name="editorial" id="editorial" placeholder="Editorial"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                </div>
            </div>

            <!-- Imagen del Libro -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Imagen Actual</label>
                <div class="mt-2">
                    <img src="img/imgLibro/<?php printf($libro->getFoto()); ?>" alt="Imagen del Libro" class="w-24 h-24 object-cover rounded-md border">
                </div>
            </div>

            <!-- Campo de Nueva Imagen -->
            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700">Subir Nueva Imagen</label>
                <div class="mt-2">
                    <input type="file" name="foto" id="foto" 
                        class="block w-full text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm cursor-pointer focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                </div>
            </div>

            <!-- Campo de Descripción -->
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <div class="mt-2">
                    <input value="<?php printf($libro->getDescripcion()); ?>" type="text" name="descripcion" id="descripcion" placeholder="Descripción"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                </div>
            </div>

            <!-- Campo de Categoría -->
            <div>
                <label for="idCategoria" class="block text-sm font-medium text-gray-700">Categoría</label>
                <div class="mt-2">
                    <select name="idCategoria" id="idCategoria" 
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                        <?php foreach ($categorias as $categoria): ?>
                            <?php if ($categoria->getIdCategoria() == $libro->getIdCategoria()): ?>
                                <option value="<?= $categoria->getIdCategoria(); ?>" selected><?= $categoria->getNombre(); ?></option>
                            <?php else: ?>
                                <option value="<?= $categoria->getIdCategoria(); ?>"><?= $categoria->getNombre(); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Campo Oculto -->
            <input type="hidden" name="idLibro" id="idLibro" value="<?php printf($libro->getIdLibro()); ?>">

            <!-- Botón de Enviar -->
            <div>
                <button type="button" onclick="javascript:procesarEditarLibros()" 
                    class="w-full bg-indigo-600 text-white font-medium py-2 px-4 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Enviar</button>
            </div>
        </form>
    </div>
</body>
</html>
