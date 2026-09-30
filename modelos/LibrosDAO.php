<?php

class LibrosDAO {
    private mysqli $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Obtiene un libro de la BD en función del email
     * @return libro Devuelve un Objeto de la clase libro o null si no existe
     */
    public function getByTitulo($titulo):Libro|null {
        if(!$stmt = $this->conn->prepare("SELECT * FROM libros WHERE titulo = ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Asociar las variables a las interrogaciones(parámetros)
        $stmt->bind_param('s',$titulo);
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        //Si ha encontrado algún resultado devolvemos un objeto de la clase Mensaje, sino null
        if($result->num_rows >= 1){
            $libro = $result->fetch_object(Libro::class);
            return $libro;
        }
        else{
            return null;
        }
    } 

    /**
     * Obtiene un libro de la BD en función del email
     * @return libro Devuelve un Objeto de la clase libro o null si no existe
     */
    public function buscarLibros($busqueda):array{
        if(!$stmt = $this->conn->prepare("SELECT categorias.nombre, libros.titulo, libros.idLibro, libros.foto, libros.descripcion FROM libros INNER JOIN categorias ON libros.idCategoria = categorias.idCategoria WHERE titulo LIKE ? ORDER BY categorias.nombre, libros.titulo"))

        {
            echo "Error en la SQL: " . $this->conn->error;
        }


        // Agregar comodines '%' para buscar parcialmente las palabras clave
        $searchTerm = '%' . $busqueda . '%';
        //Asociar las variables a las interrogaciones(parámetros)
        $stmt->bind_param('s', $searchTerm);
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        $array_libros = array();
        
        while($libro = $result->fetch_array()){
            $array_libros[] = $libro;
        }
        return $array_libros;
    } 



    public function getByIdLibro($idlibro):libro|null {
        if(!$stmt = $this->conn->prepare("SELECT * FROM libros WHERE idlibro = ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Asociar las variables a las interrogaciones(parámetros)
        $stmt->bind_param('s',$idlibro);
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        //Si ha encontrado algún resultado devolvemos un objeto de la clase Mensaje, sino null
        if($result->num_rows >= 1){
            $libro = $result->fetch_object(libro::class);
            return $libro;
        }
        else{
            return null;
        }
    } 

    /**
     * Obtiene todos los libros de la tabla mensajes
     */
    public function getLibrosCategoria():array {
        if(!$stmt = $this->conn->prepare("SELECT categorias.nombre, libros.titulo, libros.idLibro, libros.foto, libros.descripcion FROM libros INNER JOIN categorias ON libros.idCategoria = categorias.idCategoria ORDER BY categorias.nombre, libros.titulo"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        $array_libros = array();
        
        while($libro = $result->fetch_array()){
            $array_libros[] = $libro;
        }
        return $array_libros;
    }


    /**
     * Inserta en la base de datos el libro que recibe como parámetro
     * @return idlibro Devuelve el id autonumérico que se le ha asignado al libro o false en caso de error
     */
    function insert(Libro $libro): int|bool{
        if(!$stmt = $this->conn->prepare("INSERT INTO libros (titulo, editorial, descripcion, foto, idCategoria) VALUES (?,?,?,?,?)")){
            die("Error al preparar la consulta insert: " . $this->conn->error );
        }
        $titulo = $libro->getTitulo();
        $editorial = $libro->getEditorial();
        $descripcion = $libro->getDescripcion();
        $foto = $libro->getFoto();
        $idCategoria = $libro->getIdCategoria();
        $stmt->bind_param('ssssi',$titulo, $editorial, $descripcion, $foto, $idCategoria);
        if($stmt->execute()){
            return $stmt->insert_id;
        }
        else{
            return false;
        }
    }


    /**
     * Inserta en la base de datos el libro que recibe como parámetro
     * @return idlibro Devuelve el id autonumérico que se le ha asignado al libro o false en caso de error
     */ 
    function update(Libro $libro): int|bool{

        $titulo = $libro->getTitulo();
        $editorial = $libro->getEditorial();
        $descripcion = $libro->getDescripcion();
        $foto = $libro->getFoto();
        $idLibro = $libro->getIdLibro();
        $idCategoria = $libro->getIdCategoria();

        if($foto == null){
            if(!$stmt = $this->conn->prepare("UPDATE libros SET titulo = ?, editorial = ?, descripcion = ?, idCategoria = ? WHERE idLibro = ?")){
                die("Error al preparar la consulta update: " . $this->conn->error );
            }
            $stmt->bind_param('sssii',$titulo, $editorial, $descripcion, $idCategoria, $idLibro);
        }else {
            if(!$stmt = $this->conn->prepare("UPDATE libros SET titulo = ?, editorial = ?, descripcion = ?, foto = ?, idCategoria = ? WHERE idLibro = ?")){
                die("Error al preparar la consulta update: " . $this->conn->error );
            }
            $stmt->bind_param('ssssii',$titulo, $editorial, $descripcion, $foto, $idCategoria, $idLibro);
        }

    
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function eliminarLibro($idLibro) {
        if(!$stmt = $this->conn->prepare("DELETE FROM libros WHERE idLibro = ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }

        $stmt->bind_param('i', $idLibro);
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}
?>
