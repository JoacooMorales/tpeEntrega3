<?php
require_once './app/models/album.model.php';
require_once './app/views/album.view.php';
require_once './app/helpers/auth.helper.php';

class AlbumController {
    private $view;
    private $model;

    public function __construct() {
        //AuthHelper::verify();
        $this->view = new AlbumView();
        $this->model = new AlbumesModel();
    } 

    public function showAlbum() {
        AuthHelper::init();
        $artistas = $this->model->getArtistasForAlbumes();
        // Obtén los albumes desde el modelo
        $albumes = $this->model->getAlbum();
        // Muestra los albumes desde la vista
        $this->view->showAlbum($albumes,$artistas);
    }




    public function addAlbum() {
        AuthHelper::verify();

        // Obtén los datos del formulario
        $tituloAlbum = $_POST['tituloAlbum'];
        $anioLanzamiento = $_POST['anioLanzamiento'];
        $artistaID = $_POST['artistaID'];

        // Validaciones
        if (empty($tituloAlbum) || empty($anioLanzamiento)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertAlbum($tituloAlbum, $anioLanzamiento, $artistaID);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showError("Error al insertar el álbum");
        }
    }


    public function removeAlbum($id) {
        AuthHelper::verify();
        $this->model->deleteAlbum($id);
        header('Location: ' . BASE_URL);
    }
    
    function editarAlbum() {
        AuthHelper::verify();
        $albumes = $this->model->getAlbum();
        $this->view->showPantallaEditora($albumes);
        


        
        //header('Location: ' . BASE_URL);
    }

    function getAlbumes(){
        $albumes = $this->model->getAlbumes();
        return $albumes;
    }
    

}

