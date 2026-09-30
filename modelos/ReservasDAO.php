<?php

class ReservasDAO {
    private mysqli $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }


    public function buscarReservaIdUsuario($idUsuario):array {
        if(!$stmt = $this->conn->prepare("SELECT * FROM reservas WHERE idUsuario = ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Asociar las variables a las interrogaciones(parámetros)
        $stmt->bind_param('i',$idUsuario);
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        $array_reservas = array();
        
        while($reserva = $result->fetch_object(Reserva::class)){
            $array_reservas[] = $reserva;
        }
        return $array_reservas;
    } 


    public function buscarReservaIdLibro($idLibro): Reserva|null {
        if(!$stmt = $this->conn->prepare("SELECT * FROM reservas WHERE idLibro = ? LIMIT 1"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Asociar las variables a las interrogaciones(parámetros)
        $stmt->bind_param('i',$idLibro);
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        $array_reservas = array();
        
        while($reserva = $result->fetch_object(Reserva::class)){
            //$array_reservas[] = $reserva;
            return $reserva;
        }
        return null;
    } 

    public function buscarReservas():array {
        if(!$stmt = $this->conn->prepare("SELECT libros.titulo, usuarios.email, reservas.idReserva FROM reservas INNER JOIN usuarios ON reservas.idUsuario = usuarios.idUsuario INNER JOIN libros ON reservas.idLibro = libros.idLibro"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        $array_reservas = array();
        
        while($reserva = $result->fetch_object(Reserva::class)){
            $array_reservas[] = $reserva;
        }
        return $array_reservas;
    } 
    

 
    function insertReserva($idLibro): int|bool{
        if(!$stmt = $this->conn->prepare("INSERT INTO reservas (idLibro, idUsuario) VALUES (?,?)")){
            die("Error al preparar la consulta insert: " . $this->conn->error );
        }
        $idUsuario = Sesion::getUsuario()->getIdUsuario();

        $stmt->bind_param('ii',$idLibro, $idUsuario);
        if($stmt->execute()){
            return $stmt->insert_id;
        }
        else{
            return false;
        }
    } 

    function cancelarReserva($idLibro): int|bool{
        if(!$stmt = $this->conn->prepare("DELETE FROM reservas WHERE idLibro = ? limit 1")){
            die("Error al preparar la consulta delete: " . $this->conn->error );
        }
        

        $stmt->bind_param('i',$idLibro);
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    } 

    function buscarReservaIdLibroIdUsuario($idLibro): int|bool{
        $idUsuario = Sesion::getUsuario()->getIdUsuario();
        if(!$stmt = $this->conn->prepare("SELECT * FROM reservas WHERE idLibro = ? AND idUsuario = ?")){
            die("Error al preparar la consulta delete: " . $this->conn->error );
        }
        $stmt->bind_param('ii',$idLibro, $idUsuario);
        

        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows >= 1){            
            return true;
            }else{
                return false;
            }
        }
        else{
            return false;
        }
    }



    public function buscarReservasActivas(): array {
    
        if (!$stmt = $this->conn->prepare("SELECT libros.titulo, usuarios.email, r.fecha_Reserva 
        FROM reservas r 
        JOIN libros ON r.idLibro = libros.idLibro 
        JOIN usuarios ON r.idUsuario = usuarios.idUsuario")) {
            die("Error en la SQL: " . $this->conn->error);
        }

        $libros = array();

        if($stmt->execute()){
                
            $result = $stmt->get_result();

            
                while($libro = $result->fetch_array()){
                    $libros[] = $libro;
                }
                return $libros;

                }else{

            return false;
        }
    }

}
?>
