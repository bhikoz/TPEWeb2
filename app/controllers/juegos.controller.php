<?php
require_once './app/views/juegos.view.php';
require_once './app/models/juegos.model.php';

class JuegosController {

    private $model;
    private $view;
    private $generosModel;
    public function __construct() {
        $this->view = new juegosView();
        $this->model = new juegosModel();
        $this->generosModel = new generosModel();
    }

    public function showJuegos(){
        $verify = AuthHelper::verify();
        $Juegos = $this->model->getJuegos();
        $generos = $this->generosModel->getGeneros();
        $this->view->ShowJuegos($Juegos, $generos, $verify);
    }

    public function showJuegoXGenero($id_genero) {
        $juegos = $this->model->getJuegosXGenero($id_genero);
        $this->view->showJuegosXGenero($juegos);
    }

    public function showDetalleJuego($id_Juego) {
        $Juego = $this->model->mostrarDetalleJuego($id_Juego);
        $this->view->mostrarDetalle($Juego);
    }

   public function addJuego() {
    $verify = AuthHelper::verify();
  
    if ($verify) {
        $titulo = $_POST['titulo'];
        $id_genero = $_POST['id_genero'];
        $anio_publicacion = $_POST['anio_publicacion'];
        $imagen = $_POST['imagen'];
        $sinopsis = $_POST['sinopsis'];

        foreach ($_POST as $item) {
            if (empty($item)) {
                $this->view->showError("Debe completar todos los campos");
                return;
            }
        }

        if (!filter_var($imagen, FILTER_VALIDATE_URL)) {
            $this->view->showError("El link de la imagen no es válido");
            return;
        }

        $id_juego = $this->model->agregarJuego($titulo, $id_genero, $anio_publicacion, $imagen, $sinopsis);

        if ($id_juego) {
            header('Location: ' . BASE_URL . 'showJuegos');
        } else {
            $this->view->showError("Error al insertar el juego");
        }
    } else {
        header('Location: ' . BASE_URL . 'showJuegos');
    }
}
  

    function removeJuegos($id_Juego) {
        $this->model->eliminarJuego($id_Juego);
        header('Location: ' . BASE_URL . 'showJuegos');
    }


    public function formModificarJuego($id_Juego) {
      $verify = AuthHelper::verify();
    
      if ($verify) {
        $Juego = $this->model->getJuegoById($id_Juego);
        $generos = $this->generosModel->getGeneros();
        if ($Juego) {
          $this->view->mostrarFormModJuego($Juego, $generos, $verify);
        } else {
          header('Location: ' . BASE_URL . 'showJuegos');
        }
      } else {
        $this->view->showError("No tienes permisos suficientes");
      }
    }    
    public function editJuego($id_Juego) {
    $verify = AuthHelper::verify();

    if ($verify) {
        $titulo = $_POST["titulo"];
        $id_Genero = $_POST["id_genero"];
        $anio_publicacion = $_POST["anio_publicacion"];
        $imagen = $_POST["imagen"];
        $sinopsis = $_POST["sinopsis"];

        try {
            $this->model->editJuego($id_Juego, $titulo, $id_Genero, $anio_publicacion, $imagen, $sinopsis);
            header('Location: ' . BASE_URL . 'showJuegos');
        } catch (Exception $e) {
            $this->view->showError($e->getMessage());
        }
    } else {
        header("location: " . BASE_URL . "formModificarJuego/" . $id_Juego);
    }
}
  

}