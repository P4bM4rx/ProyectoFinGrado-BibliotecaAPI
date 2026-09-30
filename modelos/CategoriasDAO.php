<?php

class CategoriasDAO {
    private mysqli $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }


    /**
     * Obtiene todos los usuarios de la tabla mensajes
     */
    public function getAll():array {
        if(!$stmt = $this->conn->prepare("SELECT * FROM categorias ORDER BY nombre"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        $array_categoria = array();
        
        while($categoria = $result->fetch_object(Categoria::class)){
            $array_categoria[] = $categoria;
        }
        return $array_categoria;
    }
}
?>