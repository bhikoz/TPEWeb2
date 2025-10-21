<?php
require_once './app/views/generos.view.php';
require_once './app/models/generos.model.php';
require_once("./app/helpers/auth.helper.php");

class GenerosController {

    private $view;
    private $model;

    function __construct() {
        $this->model = new GenerosModel();
        $this->view = new GenerosView();
    }

    public function showGeneros() {
        $verify = AuthHelper::verify();
        $Generos = $this->model->getGeneros();  
    
        $this->view->mostrarGeneros($Generos, $verify);
    }

    public function agregarGenero(){
        $verify = AuthHelper::verify();
        if($verify){
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];

            if(empty($nombre) || empty($descripcion)){
                $this->view->showError("Debe completar todos los campos");
                return;
            }
    
            $id = $this->model->agregarGenero($nombre, $descripcion);
    
            if($id){
                header("location: ". BASE_URL . "Generos" );
            } else {
                $this->view->showError("Los datos no pueden ser cargados");
            }
        } else {
            $this->view->showError("No tienes permisos suficientes");
        }
    }

    public function removeGenero($id_Genero) {
        $verify = AuthHelper::verify();
        if ($verify) {
            try {
                $this->model->eliminarGenero($id_Genero);
                header("location: " . BASE_URL . "Generos");
            } catch (Exception) { 
                $this->view->showError("No se puede eliminar Generos");
            }
        }
    }

    public function formModificarGenero($id_Genero) {
        $verify = AuthHelper::verify();
        if ($verify) {
          $Genero = $this->model->getGeneroById($id_Genero);
          if ($Genero) {
            $this->view->mostrarFormModGenero($Genero);
          } else {
            header("location: " . BASE_URL . "Generos");
          }
        } else {
          $this->view->showError("No tienes permisos suficientes");
        }
      }
    
      public function modificarGenero($id_Genero) {
        $verify = AuthHelper::verify();
        if ($verify) {
          $nombre = $_POST["nombre"];
          $descripcion = $_POST["descripcion"];
            
          try {
            $this->model->modificarGenero($id_Genero, $nombre, $descripcion);
            header("location: " . BASE_URL . "Generos");
          } catch (Exception $e) {
            $this->view->showError($e->getMessage());
          }
        } else {
          header("location: " . BASE_URL . "formModificarGenero/" . $id_Genero);
        }
      }
}
