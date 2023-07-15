<?php

namespace Controllers;

use Model\FotosHabitaciones;
use Model\Habitacion;
use MVC\Router;

class PaginaController {

    public static function index(Router $router) {
    
        $router->render('/paginas/index', [

        ]);
    }

    public static function room(Router $router) {
        $lenguaje = lenguaje();
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        $id = validarORedireccionar($referer);

        $habitacion = Habitacion::where('castillo', $id);
        $fotosHabitacion = FotosHabitaciones::getFotosbyRoom($habitacion->id);
        //debuguear($habitacion);

        $router->renderOverlay('paginas/room', [
            'habitacion' => $habitacion,
            'lenguaje' => $lenguaje,
            'fotosHabitacion' => $fotosHabitacion
        ]);
    }
    
}