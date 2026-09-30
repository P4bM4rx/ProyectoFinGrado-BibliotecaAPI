<?php 

Class ControladorUsuarios{
    public function registrar(){
        $error='';

        if($_SERVER['REQUEST_METHOD']=='POST'){

            //Limpiamos los datos
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);
            $fotoDNI = htmlentities($_FILES["fotoDNI"]["name"]);
            $admin = 0;
            $targetDir = "img/imgUsuario/";  // Directory where uploaded files will be stored
            $fotoDNI = time() . "_" . basename($_FILES["fotoDNI"]["name"]);
            $targetFile = $targetDir . $fotoDNI;

            if (!isset($_FILES['fotoDNI']) || $_FILES['fotoDNI']['error'] != UPLOAD_ERR_OK) {
                $error = "Error al subir la foto del DNI";
            } else {
                if (move_uploaded_file($_FILES["fotoDNI"]["tmp_name"], $targetFile)) {
                    // Procesamos la foto
                // $fotoDNI = file_get_contents($_FILES['fotoDNI']['tmp_name']);
        
                    // Conectamos con la BD
                    $conexionDB = new ConexionDB(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
                    $conn = $conexionDB->getConexion();

        
                    // Compruebo que no haya un usuario registrado con el mismo email
                    $usuariosDAO = new UsuariosDAO($conn);
                    if ($usuariosDAO->getByEmail($email) != null) {
                        $error = "Ya hay un usuario con ese email";
                    } else {
                        // Insertamos en la BD
                        $usuario = new Usuario();
                        $usuario->setEmail($email);
                        $usuario->setAdmin($admin);
                        $usuario->setFotoDNI($fotoDNI);
        

                        // Encriptamos el password
                        $passwordCifrado = password_hash($password, PASSWORD_DEFAULT);
                        $usuario->setPassword($passwordCifrado);
        
                        // Generamos un SID (suponiendo que hay un método para esto)
                        $usuario->setSid(sha1(rand() + time()), true);
        
                        if ($usuariosDAO->insert($usuario)) {
                            header("location: index.php");
                            die();
                        } else {
                            $error = "No se ha podido insertar el usuario";
                        }
                    } 
                }else {
                    $error = "No se ha podido subir la foto";
                }
            }
        }
    
        require 'vistas/ajaxRegistrar.php';
    }

    public function login(){

        if($_SERVER['REQUEST_METHOD']=='POST'){
            //Creamos la conexión utilizando la clase que hemos creado
            $conexionDB = new ConexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
            $conn = $conexionDB->getConexion();

            //limpiamos los datos que vienen del usuario
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            //Validamos el usuario
            $usuariosDAO = new UsuariosDAO($conn);
            if($usuario = $usuariosDAO->getByEmail($email)){
                if(password_verify($password, $usuario->getPassword()))
                    {
                        //email y password correctos. Inciamos sesión
                        Sesion::iniciarSesion($usuario);
                        Sesion::IsAdminSesion($usuario->getAdmin());
                
                        //Creamos la cookie para que nos recuerde 1 semana
                        setcookie('sid',$usuario->getSid(),time()+24*60*60,'/');
                        
                        require 'vistas/ajaxLogin.php';
                        die();
                        header('location: index.php');
                    }
                }
            //email o password incorrectos, redirigir a index.php
            guardarMensaje("Email o password incorrectos");
            header('location: index.php');
        }
    }

    public function logout(){
        Sesion::cerrarSesion();
        setcookie('sid','',0,'/');
        header('location: index.php');
    }



    public function inicio(){
        //Incluyo la vista
        require 'vistas/ajaxInicio.php';
    }

    public function pintarMenuHorizontal(){
        //Incluyo la vista
        require 'vistas/ajaxMenuHorizontal.php';
    }

    public function verSobreMi() {
        // Incluye la vista sobreMi.php
        require_once 'vistas/verSobreMi.php';
    }
    

}