<?php

namespace Controllers;

use MVC\Router;

class ReservasController {

    public static function index(Router $router) {

        $router->render('acommodation/index', [

        ]);

    }
    public static function confirm (Router $router) {
       $roomNumber = validarORedireccionar('/','roomNumber');
       validarFecha($_GET['checkIn']) ? $checkIn = $_GET['checkIn'] : header('location: /acommodation');
       validarFecha($_GET['checkOut']) ? $checkOut = $_GET['checkOut'] : header('location: /acommodation') ;


       // TODO Comprobar si el usuario esta logado

       // TODO si no lo esta crear un usuario temporal

       // TODO registrar la reserva
    }
}