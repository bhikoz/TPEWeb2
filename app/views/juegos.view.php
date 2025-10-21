<?php

class JuegosView {
    
    public function showJuegos($Juegos, $generos, $verify = false){
        require_once("templates/juegos.phtml");
    }

    public function showJuegosXGenero($Juegos){
        require_once("templates/JuegoXGenero.phtml");
    }

    public function mostrarDetalle($Juego){
        require_once("templates/detalleJuego.phtml");
    }

    public function mostrarFormModJuego($Juego, $generos, $verify) {
        require_once "templates/formEditJuego.phtml";
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}