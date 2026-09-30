<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="web/css/estilos.css">
    <link rel="stylesheet" href="estilos/verLibros.css">
    <link rel="stylesheet" href="estilos/tailwind.css">

    <!-- Incluye Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<header>
    <h1 class="tituloPagina">Reserva de libros</h1>
</header>

<main>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php 
    $idUsuario = Sesion::getUsuario()->getIdUsuario(); 
    $admin = Sesion::getUsuario()->getAdmin(); 
    $x = 0;
    ?>

    <table>
        <tr>
            <th>Categoría</th>
            <th>Título</th>
            <th>Foto</th>
            <th>Descripción</th>
            <th>Reservar</th>
            <?php if($admin): ?>
                <th>Editar</th>
                <th>Prestar/Devolver</th>
                <th>Eliminar Libro</th>
            <?php endif; ?>
        </tr>    

        <?php while($x < count($libros)): ?>
            <?php 
            $idLibro = $libros[$x][2]; 
            $reserva = $reservasDAO->buscarReservaIdLibro($idLibro); 
            $prestamo = $prestamosDAO->buscarPrestamosActivosByIdLibro($idLibro); 

            // Ruta completa de la imagen
            $nombreImagen = htmlspecialchars($libros[$x][3]);
            $rutaImagen = "img/imgLibro/" . $nombreImagen;
            ?>
            <tr>
                <td><?= htmlspecialchars($libros[$x][0]) ?></td>
                <td><?= htmlspecialchars($libros[$x][1]) ?></td>
                <td>
                    <?php if (file_exists($rutaImagen)): ?>
                        <img src="<?= $rutaImagen ?>" alt="Imagen del libro" width="100">
                    <?php else: ?>
                        <p>Imagen no disponible</p>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($libros[$x][4]) ?></td>

                <td>
                    <?php if($reserva): ?>
                        <?php if($reserva->getIdUsuario() == $idUsuario): ?>
                            <a href='javascript:cancelarReserva(<?= $idLibro ?>)'>Cancelar Reserva</a>
                        <?php else: ?>
                            Reservado
                        <?php endif; ?>
                    <?php elseif($prestamo): ?>
                        Prestado
                    <?php elseif(!$admin): ?>
                        <a href='javascript:realizarReserva(<?= $idLibro ?>)'>Reservar</a>
                    <?php else: ?>
                        Disponible
                    <?php endif; ?>
                </td>

                <?php if($admin): ?>
                    <td><a href='javascript:formularioEditarLibros(<?= $idLibro ?>)'>Editar Libros</a></td>
                    <td>
                        <?php if($reserva): ?>
                            <a href='javascript:realizarPrestamo(<?= $idLibro ?>,<?= $reserva->getIdUsuario() ?>)'>Prestar Libros</a>
                        <?php elseif($prestamo): ?>
                            <a href='javascript:devolverLibro(<?= $prestamo->getIdPrestamo() ?>)'>Devolver Libro</a>
                        <?php else: ?>
                            Disponible
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href='javascript:eliminarLibro(<?= $idLibro ?>)'>Eliminar Libro</a>
                    </td>
                <?php endif; ?>
            </tr>
            <?php $x++; ?>
        <?php endwhile; ?>
    </table>
</main>

<!-- Incluye jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Incluye tu archivo JavaScript -->
<script src="js/ajax.js"></script>

</body>
</html>
