<?php
require_once './app/models/cancion.model.php';
require_once './app/views/cancion.view.php';
require_once './app/helpers/auth.helper.php';
require_once './app/models/album.model.php';

class CancionController {
    private $model;
    private $view;
    private $albumModel;

    public function __construct() {
        // verifico logueado
        $this->albumModel = new AlbumesModel();
        $this->model = new CancionModel();
        $this->view = new CancionView();
    }

    public function showCanciones($albumes=null) {
        AuthHelper::init();

        // obtengo tareas del controlador
        $canciones = $this->model->getCanciones();

        // muestro las tareas desde la vista
        $this->view->showCanciones($canciones,$albumes);
    }

    public function addCanciones() {
        AuthHelper::verify();
        // Verificar si los parámetros POST requeridos existen
        if (isset($_POST['titulo'], $_POST['Duración'], $_POST['albumID'])) {
            // Obtener los datos de la solicitud POST
            $titulo = $_POST['titulo'];
            $duracion = $_POST['Duración'];
            $albumID = $_POST['albumID'];
    
            // Realizar validaciones adicionales si es necesario
            if (empty($titulo) || empty($duracion)) {
                $this->view->showError("Debe completar todos los campos");
                return;
            }
    
            $id = $this->model->insertCanciones($titulo, $duracion, $albumID);
            if ($id) {
                header('Location: ' . BASE_URL);
            } else {
                $this->view->showError("Error al insertar la canción");
            }
        } else {
            // Manejar el caso en el que falten parámetros POST requeridos
            $this->view->showError("Faltan parámetros POST");
        }
    }


    function removeCanciones($id) {
        AuthHelper::verify();
        $this->model->deleteCanciones($id);
        header('Location: ' . BASE_URL);
    }
    
    function editarCancion($id,$albumes) {
        AuthHelper::verify();
        $canciones = $this->model->getCancionByID($id);
        $this->view->showPantallaEditora($canciones, $albumes);
        
        //header('Location: ' . BASE_URL);
    }


    function mostrarCancionesPorID($id){
        AuthHelper::init();
        $canciones = $this->model->getCancionesByAlbum($id);
        $this->view->showCanciones($canciones,null);

    }

    function actualizarCancion ($id){
        AuthHelper::verify();
        $titulo=$_POST ['nuevoTitulo'];
        $album=$_POST ['nuevoAlbum'];
        $duracion=$_POST ['nuevoDuracion'];
        if (!empty($titulo)&& !empty($album) && !empty($duracion)) { 
            $this->model->actualizarCancion($id,$titulo,$album,$duracion);
            header('Location: '. BASE_URL);
        } else {
            $this->view->showError("Debe completar todos los campos");
        }

    }

}
