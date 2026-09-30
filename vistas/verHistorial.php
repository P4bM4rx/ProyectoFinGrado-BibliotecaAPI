<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
  <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Categoría</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Título</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Estado</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Fecha de préstamo</th>
            </tr>    
        </thead>

            <?php
            if (is_array($libros) && !empty($libros)): 
                foreach($libros as $libro): 
                    $estado = $libro['devuelto'] ? 'Devuelto' : 'En propiedad';
            ?>
            <tbody class="divide-y divide-gray-200 bg-white">
                <tr class="hover:bg-gray-50">
                    <td class="whitespace-nowrap px-4 py-3 text-gray-900"><?= htmlspecialchars($libro["nombre"], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="px-4 py-3 text-gray-600"><?= htmlspecialchars($libro["titulo"], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="px-4 py-3">
                        <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 <?= $estado === 'Devuelto' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                            <?= htmlspecialchars($estado, ENT_QUOTES, 'UTF-8') ?>
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-600"><?= htmlspecialchars($libro["fecha_prestamo"], ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
            </tbody>
            <?php 
                endforeach; 
            else: 
            ?>
                <tr>
                    <td colspan="4">Error: No se encontraron libros o el formato de datos es incorrecto.</td>
                </tr>
            <?php endif; ?>
    </table>
</div>
</body>