<?php

namespace Controllers;

use Model\Eventos;
use MVC\Router;

class EventosController {
    public static function index (Router $router) {
        $router->render('/events/index', [

        ]);
    }

    
    public static function admin (Router $router) {
        $eventos = Eventos::getShort();
        $router->render('events/admin/index', [
            'eventos' => $eventos
        ]);
    }

    public static function create(Router $router) {
        $lenguaje = lenguaje();


        $alertas = Eventos::getAlertas();
        $evento = new Eventos();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            debuguear($_FILES);
            $evento = new Eventos($_POST['evento']);
            $alertas = $evento->validar();
        

            if(empty($alertas)){
                $resultado = $evento->guardar();

                if($resultado){

                    header('location: /admin/events?alert=1');
                }
            }
        }

        $router->render('/events/admin/create', [
            'evento'=> $evento,
            'alertas' => $alertas,
            'lenguaje' => $lenguaje
        ]);
    }
    
    public static function update (Router $router) {
        $lenguaje = lenguaje();

        $id = validarORedireccionar('/admin/events?error=4');
        $evento = Eventos::find($id);
        $alertas = Eventos::getAlertas();

        if(!empty($evento)) {
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $args = $_POST['evento'];
                $evento->sincronizar($args);
                $alertas = $evento->validar();
                
                if (empty($alertas)) {
                    $resultado = $evento->guardar();
                    if ($resultado) {
                        header('location: /admin/events?alert=3');
                    }
                }
            }
        } else {

            header('location: /admin/events?error=3');
        }

        $router->render('/events/admin/update',[
            'evento' => $evento,
            'alertas' => $alertas,
            'lenguaje' => $lenguaje
        ]);
    }
    
    public static function delete () {
        
        if ($_SERVER['REQUEST_METHOD']=== 'POST'){

            $id = $_POST ['id'] ??'';
            $id = filter_var($id , FILTER_VALIDATE_INT);
            $evento = Eventos::find($id);
            $resultado = $evento->eliminar();
            if ($resultado){ // Si el resultado es valido
                header('location: /admin/events?alerta=2');
            }
        }
    }

}