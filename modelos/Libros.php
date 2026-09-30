<?php  


class Libro{
    private $idLibro;
    private $titulo;
    private $fechaCreacion;
    private $editorial;
    private $descripcion;
    private $foto;
    private $idCategoria;

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
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo($titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of fechaCreacion
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set the value of fechaCreacion
     */
    public function setFechaCreacion($fechaCreacion): self
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }


    /**
     * Get the value of editorial
     */
    public function getEditorial()
    {
        return $this->editorial;
    }

    /**
     * Set the value of editorial
     */
    public function setEditorial($editorial): self
    {
        $this->editorial = $editorial;

        return $this;
    }

    /**
     * Get the value of foto
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     */
    public function setFoto($foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     */
    public function setDescripcion($descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * Set the value of descripcion
     */
    public function setIdCategoria($idCategoria): self
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

}