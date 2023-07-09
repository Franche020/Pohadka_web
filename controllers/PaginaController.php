<?php

namespace Controllers;

use MVC\Router;

class PaginaController {

    public static function index(Router $router) {
    
        $router->render('/paginas/index', [

        ]);
    }
    
}