<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Título del Libro</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Email del Usuario</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Fecha de la reserva</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
    <?php if (is_array($libros) && !empty($libros)): ?>
        <?php foreach($libros as $libro): ?>
                <tr class="hover:bg-gray-50">
                    <td class="whitespace-nowrap px-4 py-3 text-gray-900"><?php echo htmlspecialchars($libro["titulo"], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="px-4 py-3 text-gray-600"><?php echo htmlspecialchars($libro["email"], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="px-4 py-3 text-gray-600"><?php echo htmlspecialchars($libro["fecha_Reserva"], ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="3">Error: No se encontraron libros o el formato de datos es incorrecto.</td>
        </tr>
    <?php endif; ?>
        </tbody>
    </table>
</body>
</html>