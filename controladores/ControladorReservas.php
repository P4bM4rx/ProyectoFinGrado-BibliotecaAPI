<?php 

Class ControladorReservas{
    public function realizarReserva(){
        if($_SERVER['REQUEST_METHOD']=='GET'){
        //comprobar que nos están enviando la hora y la fecha
        $idLibro = $_GET['idLibro'];
        
        //Creamos la conexión utilizando la clase que hemos creado
        $conexionDB = new ConexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $conexionDB->getConexion();

        $reservasDAO = new ReservasDAO($conn);
        $reservas = $reservasDAO->insertReserva($idLibro);

        $prestamosDAO = new PrestamosDAO($conn);

        $librosDAO = new LibrosDAO($conn);
        $libros = $librosDAO->getLibrosCategoria();


        require 'vistas/verBuscadorLibros.php';
        }

    }

    public function cancelarReserva(){
        //comprobar que nos están enviando la hora y la fecha
        $idLibro = $_GET['idLibro'];
        
        //Creamos la conexión utilizando la clase que hemos creado
        $conexionDB = new ConexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $conexionDB->getConexion();

        $reservasDAO = new ReservasDAO($conn);
        $reservas = $reservasDAO->cancelarReserva($idLibro);

        $prestamosDAO = new PrestamosDAO($conn);

        $librosDAO = new LibrosDAO($conn);
        $libros = $librosDAO->getLibrosCategoria();

        require 'vistas/verBuscadorLibros.php';
    }



    public function realizarPrestamo(){
        if($_SERVER['REQUEST_METHOD']=='GET'){
            //Creamos la conexión utilizando la clase que hemos creado
            $conexionDB = new ConexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
            $conn = $conexionDB->getConexion();

            $idLibro = $_GET["idLibro"];
            $idUsuario = $_GET["idUsuario"];

            //Sería mejor primero cancelar la reserva y si no da error hacer el préstamo
            //Sería mucho mejor si el error lo da al hacer el préstamos y ya hemos cancelado la reserva podamos deshacerla(volver a crear la reserva con los mismos datos)
            $prestamosDAO = new PrestamosDAO($conn);
            $prestamo = $prestamosDAO->insertPrestamo($idLibro, $idUsuario);

            $reservasDAO = new ReservasDAO($conn);
            $reservasDAO->cancelarReserva($idLibro);

            $librosDAO = new LibrosDAO($conn);
            $libros = $librosDAO->getLibrosCategoria();


            require 'vistas/verBuscadorLibros.php';

        }

    }

    public function devolverLibro(){
        if($_SERVER['REQUEST_METHOD']=='GET'){
            //Creamos la conexión utilizando la clase que hemos creado
            $conexionDB = new ConexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
            $conn = $conexionDB->getConexion();

            $idPrestamo = $_GET["idPrestamo"];

            $prestamosDAO = new PrestamosDAO($conn);
            $prestamo = $prestamosDAO->devolverPrestamo($idPrestamo);

            $reservasDAO = new ReservasDAO($conn);

            $librosDAO = new LibrosDAO($conn);
            $libros = $librosDAO->getLibrosCategoria();


            require 'vistas/verBuscadorLibros.php';

        }
    }

    public function verHistorial() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Creamos la conexión utilizando la clase que hemos creado
            $conexionDB = new ConexionDB(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
            $conn = $conexionDB->getConexion();
    
            $prestamosDAO = new PrestamosDAO($conn);
            $libros = $prestamosDAO->enseniarHistorial();
    
            require 'vistas/verHistorial.php';
        }
    }
    
    public function verReservas() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Creamos la conexión utilizando la clase que hemos creado
            $conexionDB = new ConexionDB(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
            $conn = $conexionDB->getConexion();
    
            $reservasDAO = new ReservasDAO($conn);
            $libros = $reservasDAO->buscarReservasActivas();
    
            require 'vistas/verReservas.php';
        }
    }

    public function verPrestamos() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Creamos la conexión utilizando la clase que hemos creado
            $conexionDB = new ConexionDB(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
            $conn = $conexionDB->getConexion();
    
            $prestamosDAO = new PrestamosDAO($conn);
            $prestamosActivos = $prestamosDAO->buscarPrestamosActivos();
    
            require 'vistas/verPrestamos.php';
        }
    }


}