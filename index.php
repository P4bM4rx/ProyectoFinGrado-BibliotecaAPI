<?php 

require_once 'config/config.php';
require_once 'modelos/ConexionDB.php';
require_once 'modelos/Usuarios.php';
require_once 'modelos/UsuariosDAO.php';
require_once 'controladores/ControladorUsuarios.php';
require_once 'modelos/Sesion.php';
require_once '_aux/funciones.php';
require_once 'controladores/ControladorReservas.php';
require_once 'controladores/ControladorLibros.php';
require_once 'modelos/Reservas.php';
require_once 'modelos/ReservasDAO.php';
require_once 'modelos/Libros.php';
require_once 'modelos/LibrosDAO.php';
require_once 'modelos/Categoria.php';
require_once 'modelos/Prestamos.php';
require_once 'modelos/PrestamosDAO.php';
require_once 'modelos/CategoriasDAO.php';

//Uso de variables de sesión
session_start();

//Mapa de enrutamiento
$mapa = array(
    'inicio'=>array('controlador'=>'ControladorUsuarios', 
                    'metodo'=>'inicio', 
                    'privada'=>false),
    'login'=>array('controlador'=>'ControladorUsuarios', 
                   'metodo'=>'login', 
                   'privada'=>false),
    'logout'=>array('controlador'=>'ControladorUsuarios', 
                    'metodo'=>'logout', 
                    'privada'=>true),
    'registrar'=>array('controlador'=>'ControladorUsuarios', 
                       'metodo'=>'registrar', 
                       'privada'=>false),
    'inicioReserva'=>array('controlador'=>'ControladorReservas', 
                                    'metodo'=>'inicio', 
                                    'privada'=>true),     
    'verLibros'=>array('controlador'=>'ControladorLibros', 
                                'metodo'=>'verLibros', 
                                'privada'=>true),           
    'realizarReserva'=>array('controlador'=>'ControladorReservas', 
                                'metodo'=>'realizarReserva', 
                                'privada'=>true),
    'cancelarReserva'=>array('controlador'=>'ControladorReservas', 
                                'metodo'=>'cancelarReserva', 
                                'privada'=>true),
    'buscarLibros'=>array('controlador'=>'ControladorLibros', 
                                'metodo'=>'buscarLibros', 
                                'privada'=>true),
    'formularioInsertarLibros'=>array('controlador'=>'ControladorLibros',
                                'metodo'=>'formularioInsertarLibros',
                                'privada'=>true),
    'insertarLibros'=>array('controlador'=>'ControladorLibros',
                                    'metodo'=>'insertarLibros',
                                    'privada'=>true),
    'formularioEditarLibros'=>array('controlador'=>'ControladorLibros',
                                        'metodo'=>'formularioEditarLibros',
                                        'privada'=>true),
    'editarLibros'=>array('controlador'=>'ControladorLibros',
                                    'metodo'=>'editarLibros',
                                    'privada'=>true),
    'realizarPrestamo'=>array('controlador'=>'ControladorReservas',
                                'metodo'=>'realizarPrestamo',
                                'privada'=>true),
    'devolverLibro'=>array('controlador'=>'ControladorReservas', 
                                'metodo'=>'devolverLibro', 
                                'privada'=>true),
    'verHistorial'=>array('controlador'=>'ControladorReservas', 
                                'metodo'=>'verHistorial', 
                                'privada'=>true),
    'verReservas'=>array('controlador'=>'ControladorReservas', 
                                'metodo'=>'verReservas', 
                                'privada'=>true),
    'verPrestamos'=>array('controlador'=>'ControladorReservas', 
                                'metodo'=>'verPrestamos', 
                                'privada'=>true),
    'eliminarLibro'=>array('controlador'=>'ControladorLibros', 
                                'metodo'=>'eliminarLibro', 
                                'privada'=>true),
    'pintarMenuHorizontal'=>array('controlador'=>'ControladorUsuarios', 
                            'metodo'=>'pintarMenuHorizontal', 
                            'privada'=>true),
    'mostrarRegistro'=>array('controlador'=>'ControladorUsuarios', 
                            'metodo'=>'mostrarFormularioRegistro', 
                            'privada'=>false),
    'verSobreMi' => array('controlador' => 'ControladorUsuarios',
                        'metodo' => 'verSobreMi',
                        'privada' => false)
);



//Parseo de la ruta
if(isset($_GET['accion'])){ //Compruebo si me han pasado una acción concreta, sino pongo la accción por defecto inicio
    if(isset($mapa[$_GET['accion']])){  //Compruebo si la accción existe en el mapa, sino muestro error 404
        $accion = $_GET['accion']; 
    }
    else{
        //La acción no existe
        header('Status: 404 Not found');
        echo 'Página no encontrada';
        die();
    }
}else{
    $accion='inicio';   //Acción por defecto
}

//Si existe la cookie y no ha iniciado sesión, le iniciamos sesión de forma automática
//if( !isset($_SESSION['email']) && isset($_COOKIE['sid'])){
if( !Sesion::existeSesion() && isset($_COOKIE['sid'])){
    //Conectamos con la bD
    $conexionDB = new ConexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
    $conn = $conexionDB->getConexion();
    
    //Nos conectamos para obtener el id y la foto del usuario
    $usuariosDAO = new UsuariosDAO($conn);
    if($usuario = $usuariosDAO->getBySid($_COOKIE['sid'])){
        //$_SESSION['email']=$usuario->getEmail();
        //$_SESSION['id']=$usuario->getId();
        //$_SESSION['foto']=$usuario->getFoto();
        Sesion::iniciarSesion($usuario);
    }
    
}

//Si la acción es privada compruebo que ha iniciado sesión, sino, lo echamos a index
// if(!isset($_SESSION['email']) && $mapa[$accion]['privada']){
if(!Sesion::existeSesion() && $mapa[$accion]['privada']){
    header('location: index.php');
    guardarError("Debes iniciar sesión para acceder a $accion");
    die();
}


//$acción ya tiene la acción a ejecutar, cogemos el controlador y metodo a ejecutar del mapa
$controlador = $mapa[$accion]['controlador'];
$metodo = $mapa[$accion]['metodo'];

//Ejecutamos el método de la clase controlador
$objeto = new $controlador();
$objeto->$metodo();