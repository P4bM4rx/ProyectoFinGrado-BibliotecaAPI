function procesarFormularioBusqueda(){
    
    $("#formBusqueda").submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "index.php?accion=buscarLibros",
            data: formData,
            success: function (response) {
                // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)
                $( "#contenedorLibros" ).html( response );
            }
        });
    });
}

function verLibros(){
    $.ajax({
        type: "GET",
        url: "index.php?accion=verLibros",
        success: function (response) {
            // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)
            $( "#contenedor" ).html( response );
        }
    });
}


function procesarInsertarLibro(){
        var form = document.getElementById('formInsertar'); 
        var formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: "index.php?accion=insertarLibros",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)
                $( "#contenedor" ).html( response );

            }
        });
}


function formularioInsertarLibros(){
    $.ajax({
        type: "GET",
        url: "index.php?accion=formularioInsertarLibros",
        success: function (response) {
            // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)
            $( "#contenedor" ).html( response );
        }
    });
}

function procesarEditarLibros() {
    // Prevenir comportamiento predeterminado del formulario
    event.preventDefault();

    var form = document.getElementById('formEditar');
    var formData = new FormData(form);

    // Realizar la petición AJAX para editar el libro
    $.ajax({
        type: "POST",
        url: "index.php?accion=editarLibros",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            // Una vez editado, cargar la lista de libros
            $.ajax({
                type: "POST",
                url: "index.php?accion=verLibros",
                success: function (response) {
                    // Actualizar el contenedor con la respuesta del servidor
                    $("#contenedor").html(response);
                }
            });
        },
        error: function (error) {
            console.error("Error en la petición AJAX:", error);
            alert("Hubo un problema al editar el libro. Intenta nuevamente.");
        }
    });
}


function formularioEditarLibros(idLibro){
    $.ajax({
        type: "GET",
        url: "index.php?accion=formularioEditarLibros&idLibro="+idLibro,
        success: function (response) {
            // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)
            $( "#contenedor" ).html( response );
        }
    });
}

function realizarReserva(idLibro){
    $.ajax({
        type: "GET",
        url: "index.php?accion=realizarReserva&idLibro="+idLibro,
        success: function (response) {
            // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)
            $( "#contenedor" ).html( response );
        }
    });
}

function cancelarReserva(idLibro){
    $.ajax({
        type: "GET",
        url: "index.php?accion=cancelarReserva&idLibro="+idLibro,
        success: function (response) {
            // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)
            $( "#contenedor" ).html( response );
        }
    });
}


function eliminarLibro(idLibro){
    if(confirm("¿Seguro que quieres eliminar el libro?")){
        $.ajax({
            type: "GET",
            url: "index.php?accion=eliminarLibro&idLibro="+idLibro,
            success: function (response) {
                // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)
                $( "#contenedor" ).html( response );
            }
        });
    }
}

function realizarPrestamo(idLibro, idUsuario){
    $.ajax({
        type: "GET",
        url: "index.php?accion=realizarPrestamo&idLibro="+idLibro+"&idUsuario="+idUsuario,
        success: function (response) {
            // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)
            $( "#contenedor" ).html( response );
        }
    });
}

function devolverLibro(idPrestamo){
    $.ajax({
        type: "GET",
        url: "index.php?accion=devolverLibro&idPrestamo="+idPrestamo,
        success: function (response) {
            // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)
            $( "#contenedor" ).html( response );
        }
    });
}

function verHistorial(){
    $.ajax({
        type: "GET",
        url: "index.php?accion=verHistorial",
        success: function (response) {
            // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)
            $( "#contenedor" ).html( response );
        }
    });
}

function verReservas(){
    $.ajax({
        type: "GET",
        url: "index.php?accion=verReservas",
        success: function (response) {
            // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)
            $( "#contenedor" ).html( response );
        }
    });
}

function verPrestamos(){
    $.ajax({
        type: "GET",
        url: "index.php?accion=verPrestamos",
        success: function (response) {
            // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)
            $( "#contenedor" ).html( response );
        }
    });
}




$(document).ready(function () {
    // Manejar el envío del formulario de inicio de sesión sin recargar la página
    $("#formLogin").submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "index.php?accion=login",
            data: formData,
            success: function (response) {
                // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)

                $( "#menu_left" ).html( response );
            }
        });
        if ($("#contenedor-menu-horizontal").children().length === 0) {
            $.ajax({
                type: "POST",
                url: "index.php?accion=pintarMenuHorizontal",
                success: function (response) {
                    $("#contenedor-menu-horizontal").html(response);
                },
                error: function () {
                    console.error("Error al cargar el menú horizontal.");
                }
            });
        }
    });



        // Evento para cargar el formulario de registro
        $('#registrar').click(function (e) {
            e.preventDefault(); // Evita que el enlace recargue la página
            
            $.ajax({
                url: 'vistas/ajaxRegistrar.php', // Ruta del archivo que contiene el formulario
                type: 'GET',
                success: function (response) {
                    // Carga la respuesta en el contenedor
                    $('#contenedor').html(response);
                },
                error: function () {
                    alert('Error al cargar el formulario de registro.');
                    }
                });
            });
    });

    function verSobreMi(){
        $.ajax({
            type: "GET",
            url: "index.php?accion=verSobreMi",
            success: function (response) {
                // Manejar la respuesta del servidor (puede redirigir o actualizar la página según necesidades)
                $( "#contenedor" ).html( response );
            }
        });
    }



