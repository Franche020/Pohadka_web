<?php

namespace Controllers;

use MVC\Router;

class ReservasController {

    public static function index(Router $router) {

        //TODO obtener una consulta en formato JSON de la ocupacion para el rango seleccionado (dia a dia y si solo uno está ocupado marcar como no disponible en el json)
        //TODO crear API para esta funcion
        //TODO Leer el json en javascript y actualizar los estados de las habitaciones coloreando el svg
        

        $router->render('acommodation/index', [

        ]);
    }
}