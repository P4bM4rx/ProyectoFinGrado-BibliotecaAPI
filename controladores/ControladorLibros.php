<?php

Class ControladorLibros{

    public function verLibros(){

        if($_SERVER['REQUEST_METHOD']=='GET'){
            //Creamos la conexión utilizando la clase que hemos creado
            $conexionDB = new ConexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
            $conn = $conexionDB->getConexion();

            $librosDAO = new LibrosDAO($conn);
            $libros = $librosDAO->getLibrosCategoria();

            $reservasDAO = new ReservasDAO($conn);

            $prestamosDAO = new PrestamosDAO($conn);
            
            require 'vistas/verBuscadorLibros.php';

        }
    }

    public function buscarLibros(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //Creamos la conexión utilizando la clase que hemos creado
            $conexionDB = new ConexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
            $conn = $conexionDB->getConexion();

            //limpiamos los datos que vienen del usuario
            $busqueda = htmlspecialchars($_POST['busqueda']);

            $librosDAO = new LibrosDAO($conn);
            $libros = $librosDAO->buscarLibros($busqueda);

            $reservasDAO = new ReservasDAO($conn);

            $prestamosDAO = new PrestamosDAO($conn);
            
            require 'vistas/verLibrosCategoria.php';
        }
    }

    public function insertarLibros(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            
            //Creamos la conexión utilizando la clase que hemos creado
            $conexionDB = new ConexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
            $conn = $conexionDB->getConexion();

            //limpiamos los datos que vienen del usuario
            $titulo = htmlspecialchars($_POST['titulo']);
            $editorial = htmlspecialchars($_POST['editorial']);
            $foto = htmlspecialchars($_FILES['foto']["name"]);
            $descripcion = htmlspecialchars($_POST['descripcion']);
            $idCategoria = htmlspecialchars($_POST['idCategoria']);

            $targetDir = "img/imgLibro/";  // Directory where uploaded files will be stored
            $foto = time() . "_" . basename($_FILES["foto"]["name"]);
            $targetFile = $targetDir . $foto;

            if (!isset($_FILES['foto']) || $_FILES['foto']['error'] != UPLOAD_ERR_OK) {
                $error = "Error al subir la foto del Libro";
            } else {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
                    // Procesamos la foto

                    //Compruebo que no haya un usuario registrado con el mismo email
                    $librosDAO = new LibrosDAO($conn);

                    $reservasDAO = new ReservasDAO($conn);

                    $prestamosDAO = new PrestamosDAO($conn);
                    if($librosDAO->getByTitulo($titulo) != null){
                        $error = "Ya está ese libro registrado";
                    }
                    else{
                        
                        //Insertamos en la BD

                        $libro = new Libro();
                        $libro->setTitulo($titulo);
                        $libro->setEditorial($editorial);
                        $libro->setFoto($foto);
                        $libro->setDescripcion($descripcion);
                        $libro->setIdCategoria($idCategoria);
                        

                        if($librosDAO->insert($libro)){

                            $librosDAO = new LibrosDAO($conn);
                            $libros = $librosDAO->getLibrosCategoria();
                            
                            require 'vistas/verBuscadorLibros.php';
                        }else{
                            $error = "No se ha podido insertar el libro";
                        }
                    }
                } else {
                    $error = "No se ha podido insertar la foto";
                }
            }
        }
        require 'vistas/verBuscadorLibros.php';
    }

    public function editarLibros(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //Creamos la conexión utilizando la clase que hemos creado
            $conexionDB = new ConexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
            $conn = $conexionDB->getConexion();

            //limpiamos los datos que vienen del usuario
            $idLibro = htmlspecialchars($_POST['idLibro']);
            $titulo = htmlspecialchars($_POST['titulo']);
            $editorial = htmlspecialchars($_POST['editorial']);
            $descripcion = htmlspecialchars($_POST['descripcion']);
            $idCategoria = htmlspecialchars($_POST['idCategoria']);

            $libro = new Libro();
            $libro->setTitulo($titulo);
            $libro->setEditorial($editorial);
            $libro->setDescripcion($descripcion);
            $libro->setIdCategoria($idCategoria);
            $libro->setIdLibro($idLibro);

            if(isset($_FILES['foto'])){
                $foto = htmlspecialchars($_FILES['foto']['name']);
                $targetDir = "img/imgLibro/";  // Directory where uploaded files will be stored
                $foto = time() . "_" . basename($_FILES["foto"]["name"]);
                $targetFile = $targetDir . $foto;
            
                if ($_FILES['foto']['error'] != UPLOAD_ERR_OK) {
                    $error = "Error al subir la foto del Libro";
                } else {
                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
                        $libro->setFoto($foto);
                        } else {
                            $error = "No se ha podido insertar la foto";
                    }
                }
            }

            $librosDAO = new LibrosDAO($conn);
            if($librosDAO->update($libro)){

                $librosDAO = new LibrosDAO($conn);
                $libros = $librosDAO->getLibrosCategoria();

                $reservasDAO = new ReservasDAO($conn);

                $prestamosDAO = new PrestamosDAO($conn);
                
                require 'vistas/verBuscadorLibros.php';
            }else{
                $error = "No se ha podido editar el libro";
            }
        }
        
    }


    public function formularioEditarLibros(){
        if($_SERVER['REQUEST_METHOD']=='GET'){
            //Creamos la conexión utilizando la clase que hemos creado
            $conexionDB = new ConexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
            $conn = $conexionDB->getConexion();
            
            $librosDAO = new LibrosDAO($conn);
            $idLibro = $_GET["idLibro"];

            $libro = $librosDAO->getByIdLibro($idLibro);
        
            $categoriasDAO = new CategoriasDAO($conn);
            $categorias = $categoriasDAO->getAll();


            require 'vistas/editarLibros.php';
        }
    }

    public function formularioInsertarLibros(){
        require 'vistas/registrarLibros.php';
    }

    public function eliminarLibro(){
        if($_SERVER['REQUEST_METHOD']=='GET'){
            $conexionDB = new ConexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
            $conn = $conexionDB->getConexion();
            
            $librosDAO = new LibrosDAO($conn);
            $idLibro = $_GET["idLibro"];

            if($librosDAO->eliminarLibro($idLibro)){
                $librosDAO = new LibrosDAO($conn);
                $libros = $librosDAO->getLibrosCategoria();

                $reservasDAO = new ReservasDAO($conn);

                $prestamosDAO = new PrestamosDAO($conn);

            require 'vistas/verBuscadorLibros.php';
            }else {
                echo("error al eliminar libro");
            }
        }
    }
}