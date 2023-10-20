<?php

namespace Controllers;

use Model\Reservas;
use MVC\Router;

class UsuariosController {
    public static function index (Router $router) {
        isSession();
        $reservas = Reservas::getReservasbyUser($_SESSION['id']);
        
        
        // TODO Generar tablas con las reservas

        $router->render('/usuarios/perfil', [
            'titulo' => 'User Profile',
            'reservas' => $reservas

        ]);
    }
}