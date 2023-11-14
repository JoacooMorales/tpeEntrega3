<?php 
    require_once 'app/controllers/api.controller.php';
    require_once 'app/helpers/auth.api.helper.php';
    require_once  'app/models/cancion.model.php';

    class CancionesApiController extends ApiController{
        private $model;
        private $helper;
        protected $view;

        private $data;



        function __construct() {
            parent::__construct();

            $this->model = new CancionModel();
            $this->helper = new AuthHelper();
            $this->view = new ApiView();
        }
        

       // /api/canciones?sort=nombre&order=asc&field=nombre&value=UnNombre&page=1&limit=3

        function get ($params =[]) {

            if (empty($params)) {
                $cFields= ['titulo ','Duración','albumID'];
                $ordenes = ['ASC','DESC'];
                  

                    $consultaFinal = "";
                    $parcialCampo = "";
                    $ordenPorParcial = "";
                    $paginadoParcial = "";
        
                    if(isset($_GET['campo']) && isset($_GET['valor'])){
        
                        if(in_array($_GET['campo'],$cFields)){
                            
                            $campo = $_GET['campo'];
                            $valor = $_GET['valor'];
        
                            $parcialCampo = "WHERE $campo = '$valor'";
        
                        }else{
                            $this->view->response("Campo incorrecto,seleccione un valor del dominio.",400);
                            return;
                        }
        
                    }
                    
                    if(isset($_GET['ordenPor'])&& isset($_GET['orden'])){
        
                        if(in_array(($_GET['ordenPor']),$cFields)){
                            $ordenPor = $_GET['ordenPor'];
                            
                            if(in_array($_GET['orden'],$ordenes)){
                                $orden = $_GET['orden'];
                            }
                            else{
                                $this->view->response("Debe seleccionar un orden adecuado",400);
                                return;
                            }
        
                            $ordenPorParcial = "ORDER BY $ordenPor $orden ";
                        }else{
                            $this->view->response("ordenPor invalido,por favor seleccione uno adecuado",400);
                            return;
                        }
                    }
                    
                    if(isset($_GET['pagina'])){
        
                        if(is_numeric($_GET['pagina'])){
                            $pagina = $_GET['pagina'];
        
                            if(isset($_GET['limite'])){
                                $limite = $_GET['limite'];
                            }else{
                                $limite = 3;
                            }
        
                            $inicio = ((int)$pagina - 1) * ((int)$limite);
        
                            $paginadoParcial = "LIMIT $inicio,$limite ";
        
                        }else{
                            $this->view->response("Pagina invalida,por favor seleccione un valor numerico",400);
                            return;
                        }
        
                    }
                    
                    $consultaFinal = $parcialCampo.$ordenPorParcial.$paginadoParcial; //PREPARO : WHERE nombre = 'valor' ORDER BY precio ASC LIMIT 1,3
        
                    $productos = $this->model->getCancionesOrdenado($consultaFinal);
                    
                    if($productos){
                        $this->view->response($productos,200);
                        return;
                    }else{
                        $this->view->response("No se han encontrado productos relacionados con su busqueda",404);
                        return;
                    }


       
            }else{
                if($params[':ID']){
                    $id = $params[':ID'];
                    $cancion = $this -> model ->getCancionByID($id); 

                    if($cancion){
                        $this->view->response($cancion,200);
                        return;
                    }else{
                        $this->view->response("no se encontro la cancion",404);
                        return;
                    }
                }
                else{
                    $canciones = $this->model->getCanciones();
                    if($canciones){
                        $this->view->response($canciones,200);
                        return;
                    }else{
                        $this->view->response("no se encontraron las canciones",404);
                        return;
                    }
                }   
            }
        }
    

    function post (){ 
        if($this->helper->verificarCliente()){
            $body = $this->getData();

            $titulo = $body->titulo;
            $Duración = $body->Duración;
            $albumID = $body->albumID;

            if(empty($titulo) || empty($Duración) || empty($albumID)){
                $this->view->response('Por favor,complete todo los campos',400);
                return;
            }else{

                $id = $this->model->insertCanciones($titulo,$Duración,$albumID);

                $ultimoCreado = $this->model->getCancionByID($id);
                if($ultimoCreado){
                    $this->view->response($ultimoCreado, 201);
                    return;
                }else{
                    $this->view->response("No ah sido posible añadir la cancion",200);
                    return;
                }
            }
        }else{
            $this->view->response("Debe entregar un token de autorizacion",401);
            return;
        }
    }

    function put($params = []){
        if($params[':ID']){
            $id = $params[':ID'];
            $body = $this->getData();
            
            $titulo = $body->titulo;
            $Duración = $body->Duración;
            $albumID = $body->albumID;

            if(empty($titulo) || empty($Duración) || empty($albumID)){
                $this->view->response('Por favor,complete todo los campos',400);
                return;
            }

            $cancion = $this->model->actualizarCancion($id,$titulo,$Duración,$albumID);
            $this->view->response("El producto con ID = $id ah sido modificado con éxito",200);
            return;
        }else{
            $this->view->response("Debe seleccionar un ID",400);
            return;
        }
    }
    
    function delete($params = []){
        if ($params[':ID']) {
            $deleted = $this->model->deleteCanciones($params);
            if($deleted){                                                   // para verificar si es el ultimo eliminado
                $this->view->response("se borraron las canciones",200);
                return;    
            }else{
                $this->view->response("No ah sido posible eliminar la cancion",404);
                return;
            }
            
        }
        else {
            $this->view->response("Debe seleccionar un ID",400);
            return;
        }
        
    }

}


?>




    