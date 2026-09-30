<?php 

class Reserva {
    private $idReserva;
    private $idUsuario;
    private $idLibro;

	 // Getter para $idReserva
     public function getIdReserva() {
        return $this->idReserva;
    }

    // Setter para $idReserva
    public function setIdReserva($idReserva) {
        $this->idReserva = $idReserva;
    }

    // Getter para $idUsuario
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    // Setter para $idUsuario
    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    // Getter para $idLibro
    public function getIdLibro() {
        return $this->idLibro;
    }

    // Setter para $idLibro
    public function setIdLibro($idLibro) {
        $this->idLibro = $idLibro;
    }
}