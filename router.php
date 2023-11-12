<?php
require_once './config.php';
require_once './libs/router.php';
require_once './app/controllers/cancion.api.controller.php';
require_once './app/controllers/auth.api.controller.php';

$router = new Router();

    #                     endpoint      verbo         controller            método
    $router->addRoute('canciones'    ,'GET'   , 'CancionesApiController', 'get');

    $router->addRoute('canciones/:ID','GET'   , 'CancionesApiController', 'get');

    $router->addRoute('canciones'    ,'POST'  , 'CancionesApiController', 'post');

    $router->addRoute('canciones/:ID','PUT'   , 'CancionesApiController', 'put');

    $router->addRoute('canciones/:ID','DELETE', 'CancionesApiController', 'delete');

    $router->addRoute('user/token'   , 'GET'  , 'UserApiController'     , 'obtenerToken'   );

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);


?>