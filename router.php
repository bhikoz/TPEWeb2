<?php
require_once("app/controllers/generos.controller.php");
require_once("app/controllers/juegos.controller.php");
require_once("app/controllers/login.controller.php");
require_once("app/controllers/home.controller.php");

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');


$action = 'home'; 
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);
$controladorHome = new HomeController();
$controladorGeneros = new GenerosController();
$controladorJuegos = new JuegosController();
$controladorAutenticador = new LoginController();

switch ($params[0]) {
    case "home":
        $controladorHome->showHome();
        break;
    case "Generos":
        $controladorGeneros->showGeneros();
        break;
    case "agregarGenero":
        $controladorGeneros->agregarGenero();
        break;
    case "eliminarGenero":
        $controladorGeneros->removeGenero($params[1]);
        break;
    case "formModificarGenero":
        $controladorGeneros->formModificarGenero($params[1]);
        break;
    case "modificarGenero":
        $controladorGeneros->modificarGenero($params[1]);
        break;
    case "mostrarJuegoXGenero":
        $controladorJuegos->showJuegoXGenero($params[1]);
        break;
    case "mostrarDetalleJuego":
        $controladorJuegos->showdetalleJuego($params[1]);
        break;
    case "showJuegos":
        $controladorJuegos->showJuegos();
        break;
    case "agregarJuego":
        $controladorJuegos->addJuego();
        break;
    case "eliminarJuego":
        $controladorJuegos->removeJuegos($params[1]);
        break;
    case "formModificarJuego":
        $controladorJuegos->formModificarJuego($params[1]);
         break;
    case "modificarJuego":
        $controladorJuegos->editJuego($params[1]);
        break;
    case "login":
        $controladorAutenticador-> showLogin();
        break;
    case "autenticacion":
        $controladorAutenticador-> auth();
        break;
    case "logout":
        $controladorAutenticador-> logout();
        break;
    default:
        $controladorHome->mostrar404("error 404");
        break;
}  