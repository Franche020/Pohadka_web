<?php

namespace Controllers;

use Model\Habitacion;
use MVC\Router;

class HabitacionController {
    
    public static function index() {
        echo'Index habitaciones';
    }

    public static function admin (Router $router) {
        $habitaciones = Habitacion::all();

        $router->render('acommodation/admin/index', [
            'habitaciones' => $habitaciones
        ]);
    }
    public static function create(Router $router) {

        $lenguaje = lenguaje();

        $habitacion = new Habitacion();
        $alertas = Habitacion::getAlertas();
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $habitacion = new Habitacion($_POST['habitacion']);

            $alertas = $habitacion->validar();
            if (empty($alertas)){
                $resultado = $habitacion->guardar();
                if($resultado){

                    header('location: /admin/acommodation?alert=1');
                }
            }

        }

        $router->render('/acommodation/admin/create', [
            'habitacion' => $habitacion,
            'alertas' => $alertas,
            'lenguaje' => $lenguaje
        ]);
    }

    public static function update (Router $router) {
        $lenguaje = lenguaje();
        
        $id = validarORedireccionar('/acommodation/admin');
        $habitacion = Habitacion::find($id);
        $alertas = Habitacion::getAlertas();
        
        if(!empty($habitacion)) {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $args = $_POST['habitacion'];
                $habitacion->sincronizar($args);
                $alertas = $habitacion->validar();

                if (empty($alertas)) {
                    $habitacion->guardar();

                    header('location: /admin/acommodation?alert=3');
                }
            }
        } else {

            header('location: /admin/events?error=3');
        }

        //debuguear($habitacion);
        
        $router->render('/acommodation/admin/update', [
            'habitacion' => $habitacion,
            'alertas' => $alertas,
            'lenguaje' => $lenguaje
        ]);
    }

    public static function delete () {
        
        if ($_SERVER['REQUEST_METHOD']=== 'POST'){
            $id = $_POST ['id'] ??'';
            $id = filter_var($id , FILTER_VALIDATE_INT);
            $habitacion = Habitacion::find($id);
            $resultado = $habitacion->eliminar();
            if ($resultado){ // Si el resultado es valido
                header('location: /admin/acommodation?alerta=2');
            }
        }
    }

}