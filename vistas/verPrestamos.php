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
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Fecha Préstamo</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php if (empty($prestamosActivos)): ?>
                <tr>
                    <td colspan="3">No hay libros prestados actualmente.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($prestamosActivos as $prestamo): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="whitespace-nowrap px-4 py-3 text-gray-900"><?php echo htmlspecialchars($prestamo['titulo']); ?></td>
                        <td class="px-4 py-3 text-gray-600"><?php echo htmlspecialchars($prestamo['email']); ?></td>
                        <td class="px-4 py-3 text-gray-600"><?php echo htmlspecialchars($prestamo['fecha_prestamo']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>