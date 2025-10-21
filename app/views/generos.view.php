<?php

class GenerosView {

    public function mostrarGeneros($generos, $verify = false) {
        require_once("templates/generos.phtml");
    }

    public function mostrarFormModGenero($genero) {
        require_once("templates/formEditGenero.phtml");
    }

    public function showError($error) {
        require_once("templates/error.phtml");
    }
}