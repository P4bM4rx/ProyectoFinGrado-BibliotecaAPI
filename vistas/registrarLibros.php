<div class="border-b border-gray-900/10 pb-12">
<form name="formInsertar" id="formInsertar" enctype="multipart/form-data">

        <div class="sm:col-span-4">
          <label for="titulo" class="block text-sm/6 font-medium text-gray-900">Título</label>
          <div class="mt-2">
            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
              <input type="text" name="titulo" id="titulo" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="Título del libro">
            </div>
          </div>
        </div>


        <div class="sm:col-span-4">
          <label for="editorial" class="block text-sm/6 font-medium text-gray-900">Editorial</label>
          <div class="mt-2">
            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
              <input type="text" name="editorial" id="editorial" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="Editorial del libro">
            </div>
          </div>
        </div>





        <div class="col-span-full">
          <label for="foto" class="block text-sm/6 font-medium text-gray-900">Foto Libro</label>
                <div class="mt-2 flex items-center gap-x-3">
                        <input type="file" name="foto" id="foto">
                        <!-- <button type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50">Change</button> -->
                </div>
        </div>


        <div class="sm:col-span-4">
          <label for="descripcion" class="block text-sm/6 font-medium text-gray-900">Descripción</label>
          <div class="mt-2">
            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
              <input type="text" name="descripcion" id="descripcion" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="Descripción del libro">
            </div>
          </div>
        </div>





        <div class="sm:col-span-3">
          <label for="idCategoria" class="block text-sm/6 font-medium text-gray-900">Seleccione la categoría</label>
          <div class="mt-2 grid grid-cols-1">
            <select id="idCategoria" name="idCategoria" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                <option value="1">Ciencia Ficción</option>
                <option value="2">Fantasía</option>
                <option value="3">Manga</option>
                <option value="4">Bibliografía</option>
                <option value="5">Poesía</option>
                <option value="6">Terror</option>
                <option value="7">Misterio</option>
                <option value="8">Romance</option>
                <option value="9">Históricos</option>
                <option value="10">Aventura</option>
                <option value="11">Realismo mágico</option>
                <option value="12">Divulgación científica</option>
                <option value="13">Filosofía</option>             
            </select>
            <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l 2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
          </div>
        </div>



    <div class="mt-6 flex items-center justify-start gap-x-6">
    <button onclick="javascript:procesarInsertarLibro()" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enviar</button>
  </div>
</form>
</div>