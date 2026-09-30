
    <?php if (!empty($error)): ?>
        <p class="error-message"><?= $error ?></p>
    <?php endif; ?>

        <?php $x = 0; ?>

        <form name="formBusqueda" id="formBusqueda" onsubmit="procesarFormularioBusqueda(); return false;">


        <div class="sm:col-span-4">
          <label for="busqueda" class="block text-sm/6 font-medium text-gray-900">Busqueda por título</label>
          <div class="mt-2">
            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
              <input type="text" name="busqueda" id="busqueda" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="Escribe el libro que buscas">
            </div>
          </div>
        </div>

        <div class="mt-6 mb-4 flex items-center justify-start gap-x-6">
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Buscar</button>
        </div>


        </form>

        <div id="contenedorLibros">
            <?php require 'vistas/verLibrosCategoria.php'; ?>
        </div>


