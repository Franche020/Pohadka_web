<?php

namespace Controllers;

use Model\FotosHabitaciones;
use Model\Habitacion;
use MVC\Router;

class PaginaController {

    public static function index(Router $router) {
        startSession();
        $router->render('/paginas/index', [
            'titulo' => ''
        ]);
    }

}