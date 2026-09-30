<?php


class Prestamos{
    private $idPrestamo;
    private $idUsuario;
    private $idLibro;

    /**
     * Get the value of Categoria
     */
    public function getIdPrestamo()
    {
        return $this->idPrestamo;
    }

    /**
     * Set the value of Categoria
     */
    public function setIdPrestamo($idPrestamo): self
    {
        $this->idPrestamo = $idPrestamo;

        return $this;
    }

    /**
     * Get the value of idUsuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     */
    public function setIdUsuario($idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get the value of idLibro
     */
    public function getIdLibro()
    {
        return $this->idLibro;
    }

    /**
     * Set the value of idLibro
     */
    public function setIdLibro($idLibro): self
    {
        $this->idLibro = $idLibro;

        return $this;
    }

    /**
     * Get the value of devuelto
     */
    public function getDevuelto()
    {
        return $this->devuelto;
    }

    /**
     * Set the value of devuelto
     */
    public function setDevuelto($devuelto): self
    {
        $this->devuelto = $devuelto;

        return $this;
    }    
}