<?php 

class Usuario {
    private $idUsuario;
    private $email;
    private $password;
    private $admin;
    private $fotoDNI;
    private $sid;

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
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }


    /**
     * Get the value of admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set the value of admin
     */
    public function setAdmin($admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get the value of admin
     */
    public function getFotoDNI()
    {
        return $this->fotoDNI;
    }

    /**
     * Set the value of admin
     */
    public function setFotoDNI($fotoDNI): self
    {
        $this->fotoDNI = $fotoDNI;

        return $this;
    }

    /**
     * Get the value of admin
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * Set the value of admin
     */
    public function setSid($sid): self
    {
        $this->sid = $sid;

        return $this;
    }

}