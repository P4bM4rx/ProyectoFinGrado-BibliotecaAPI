<?php

class PrestamosDAO {
    private mysqli $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }


    public function buscarPrestamosActivosByUsuario($idUsuario):array {
        if(!$stmt = $this->conn->prepare("SELECT * FROM prestamos WHERE devuelto = 0, idUsuario = ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Asociar las variables a las interrogaciones(parámetros)
        $stmt->bind_param('i',$idUsuario);
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        $array_prestamos = array();
        
        while($prestamo = $result->fetch_object(Prestamo::class)){
            $array_prestamos[] = $prestamo;
        }
        return $array_prestamos;
    } 

    public function buscarPrestamosDevueltosByUsuario($idUsuario):array {
        if(!$stmt = $this->conn->prepare("SELECT * FROM prestamos WHERE devuelto = 1, idUsuario = ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Asociar las variables a las interrogaciones(parámetros)
        $stmt->bind_param('i',$idUsuario);
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        $array_prestamos = array();
        
        while($prestamo = $result->fetch_object(Prestamo::class)){
            $array_prestamos[] = $prestamo;
        }
        return $array_prestamos;
    } 
 
    function insertPrestamo($idLibro, $idUsuario): int|bool{
        if(!$stmt = $this->conn->prepare("INSERT INTO prestamos (idLibro, idUsuario, devuelto) VALUES (?,?,0)")){
            die("Error al preparar la consulta insert: " . $this->conn->error );
        }

        $stmt->bind_param('ii',$idLibro, $idUsuario);
        if($stmt->execute()){
            return $stmt->insert_id;
        }
        else{
            return false;
        }
    } 

    function devolverPrestamo($idPrestamo): int|bool{
        if(!$stmt = $this->conn->prepare("UPDATE prestamos SET devuelto = 1 WHERE idPrestamo = ?")){
            die("Error al preparar la consulta insert: " . $this->conn->error );
        }

        $stmt->bind_param('i', $idPrestamo);
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    } 

    public function buscarPrestamosActivosByIdLibro($idLibro): Prestamos|null {
        if(!$stmt = $this->conn->prepare("SELECT * FROM prestamos WHERE devuelto = 0 AND idLibro = ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Asociar las variables a las interrogaciones(parámetros)
        $stmt->bind_param('i',$idLibro);
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();
        
        if($prestamo = $result->fetch_object(Prestamos::class)){
            return $prestamo;
        }else{
            return null;
        }
    } 

    public function buscarPrestamosActivos(): array {
        $query = "SELECT libros.titulo, p.fecha_prestamo, usuarios.email 
                  FROM prestamos p
                  JOIN libros ON p.idLibro = libros.idLibro
                  JOIN usuarios ON p.idUsuario = usuarios.idUsuario
                  WHERE p.devuelto = 0
                  ORDER BY p.fecha_prestamo desc";
    
        if (!$stmt = $this->conn->prepare($query)) {
            die("Error en la SQL: " . $this->conn->error);
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
        $prestamos = $result->fetch_all(MYSQLI_ASSOC);
        return $prestamos;
    }
    


    public function enseniarHistorial(){
        if(!$stmt = $this->conn->prepare("SELECT cat.nombre as nombre, libros.titulo as titulo, p.devuelto, p.fecha_prestamo FROM libros JOIN prestamos p ON p.idLibro = libros.idLibro JOIN categorias cat ON cat.idCategoria = libros.idCategoria WHERE p.idUsuario = ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        $idUsuario = Sesion::getUsuario()->getIdUsuario();
        $stmt->bind_param('i',$idUsuario);
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();
        $libros = $result->fetch_all(MYSQLI_ASSOC);
        
        return $libros;
    }

}
?>