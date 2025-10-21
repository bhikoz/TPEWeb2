<?php

class LoginView {
    public function showLogin($error = null, $verify = false) {
        require './templates/login.phtml';
    }
    
    public function mostrarError($error){
        require("templates/error.phtml");
    }
}
?>