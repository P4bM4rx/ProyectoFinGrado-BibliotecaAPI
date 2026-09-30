<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- <link rel="stylesheet" href="web/css/estilos.css"> -->
    <link rel="stylesheet" href="estilos/inicio.css"> 
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Incluye Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- Incluye Bootstrap JS y Popper.js (necesarios para ciertos componentes de Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/ajax.js"></script>
<body class="h-screen bg-gray-100">

<?php if(Sesion::getUsuario()): ?>
    <?php $idUsuario = Sesion::getUsuario()->getIdUsuario();  ?>
    <?php $admin = Sesion::getUsuario()->getAdmin();  ?>

    <?php $conexionDB = new ConexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
    $conn = $conexionDB->getConexion();

    $librosDAO = new LibrosDAO($conn);
    $reservasDAO = new ReservasDAO($conn);
    $prestamosDAO = new PrestamosDAO($conn);

    $libros = $librosDAO->getLibrosCategoria()
    ?>

    <?php endif; ?>

<div class="flex h-full">
        <!-- Menú lateral -->
        <aside class="w-1/5 bg-gray-800 p-4"  >
            <h2 class="text-lg font-semibold mb-4 text-white">Menú</h2>
            <nav class="flex flex-col space-y-2" name="menu_left" id="menu_left">
                <?php if(Sesion::getUsuario()): ?>
                    <?php require 'vistas/ajaxLogin.php' ?>
                <?php else: ?>
                    <form class="text-black" method="post" name="formLogin" id="formLogin">
                        <input type="text" name="email" placeholder="email">
                        </br>
                                <input type="password" name="password" placeholder="password">
                        </br>
                                <input type="submit" value="Iniciar sesion">
                        </br>
                    </form>
                    <a id="registrar" class="text-lg mb-4 text-white cursor-pointer">registrar</a>
                <?php endif; ?>
                <img src="img/Logo/Marchante de libros.jpeg" alt="Logotipo de Marchante de Libros" class="w-96 mx-auto shadow-lg rounded-xl">
            </nav>
        </aside>

        <!-- Contenedor principal -->
        <main class="flex-1 flex flex-col">
            <!-- Banner / Título -->
            <header class="bg-blue-600 text-white p-4 text-center text-lg font-bold">
                Marchante De Libros
            </header>
            <section name="contenedor-menu-horizontal" id="contenedor-menu-horizontal">
                <?php if(Sesion::getUsuario()): ?>
                    <?php require 'vistas/ajaxMenuHorizontal.php' ?>
                <?php endif; ?>
            </section>
            <!-- Contenedor de Respuestas AJAX -->
            
            <section name="contenedor" id="contenedor" class="flex-1 bg-white m-4 p-6 shadow rounded">
                
                    <h1 class="text-2xl font-semibold">Hola, vecino/a. Aquí comienza tu viaje literario: reserva, recoge y disfruta. ¡Tu biblioteca de siempre, ahora más cerca que nunca!</h1>
                    </br>
                    <p class="text-lg">Te damos la bienvenida a un espacio donde las historias te esperan. Reserva, retira y sumérgete en las páginas de tu próxima gran lectura. 📖</p>
                    </br>
                    <p class="text-lg">Tu comunidad, tus libros, tu biblioteca. Inicia sesión, reserva con comodidad y sigue disfrutando de la lectura en Alcázar de San Juan. ¡Gracias por estar aquí!</p>
                    
                
            </section>
            
        </main>
    </div>
   

</body>
</html>