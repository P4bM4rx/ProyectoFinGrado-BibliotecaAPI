<nav class="bg-blue-600 p-4">
        <ul class="flex justify-between">
            <?php if( $_SESSION['admin'] ): ?>
                <li class="flex-1">
                    <a href="#" onclick="formularioInsertarLibros()" class="block text-center text-white py-2 px-4 hover:bg-blue-500">Añadir Libro</a>
                </li>
                <li class="flex-1">
                    <a href="#" onclick="verReservas()" class="block text-center text-white py-2 px-4 hover:bg-blue-500">Ver Reservas</a>
                </li>
                <li class="flex-1">
                    <a href="#" onclick="verPrestamos()" class="block text-center text-white py-2 px-4 hover:bg-blue-500">Ver Préstamo</a>
                </li>
            <?php endif; ?>
                <li class="flex-1">
                    <a href="#" onclick="verLibros()" class="block text-center text-white py-2 px-4 hover:bg-blue-500">Ver Libros</a>
                </li>
                <li class="flex-1">
                    <a href="#" onclick="verHistorial()" class="block text-center text-white py-2 px-4 hover:bg-blue-500">Ver Historial</a>
                </li>
                <li class="flex-1">
                    <a href="#" onclick="verSobreMi()" class="block text-center text-white py-2 px-4 hover:bg-blue-500">Sobre Mí</a>

                </li>
        </ul>
    </nav>


