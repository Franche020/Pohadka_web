<?php

namespace Controllers;

use MVC\Router;
use Model\Eventos;
use Model\FotosEventos;
use Controllers\ImagesController;

class EventosController {
    public static function index (Router $router) {
        $router->render('events/index', [

        ]);
    }

    
    public static function admin (Router $router) {
        $eventos = Eventos::getShort();
        $router->render('admin/events/index', [
            'eventos' => $eventos
        ]);
    }

    public static function create(Router $router) {
        $lenguaje = lenguaje(); // Obtengo el lenguaje de la web para poder pasarlo a la vista y renderizar el contenido que toque
        $alertas = Eventos::getAlertas();
        $evento = new Eventos();


        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $evento = new Eventos($_POST['evento']);
            $alertas = $evento->validar();
            $resultado = false;

            if(!empty($_FILES)){
                $imagen = new ImagesController();
                $filenames = $imagen->uploadImage('evento');
            }
            if(empty($alertas)){
                $resultado = $evento->guardar();


                
            }

            if(!empty($filenames)) {
            
                for ($i = 0; $i < sizeof($filenames); $i++){
                    $argsImagenes[$i] = $_POST['fotosEventos'][$i];
                    $argsImagenes[$i]['url'] = $filenames[$i];
                    $argsImagenes[$i]['eventoId'] = $resultado['id'];
                    $argsImagenes[$i]['orden'] = validarInt($_POST['fotosEventos'][$i]['orden']);
                    //debuguear($argsImagenes);
                    $imagen = new FotosEventos($argsImagenes[$i]);
                    $imagen->guardar();
                    $imagenes[] = $imagen;
                }
            } 

            if($resultado){

                header('location: /admin/events?alert=1');
            }


        }

        $router->render('admin/events/create', [
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
        $fotosEvento = FotosEventos::getFotosbyEvent($id);

        if(!empty($evento)) {
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                $args = $_POST['evento'];
                $evento->sincronizar($args);
                $alertas = $evento->validar();
                
                if(!empty($_FILES)){
                    $imagen = new ImagesController();
                    $filenames = $imagen->uploadImage('evento');
                }

                if(!empty($filenames)) {
                    
                    for ($i = 0; $i < sizeof($filenames); $i++){
                        $argsImagenes[$i] = $_POST['fotosEventos'][$i];
                        $argsImagenes[$i]['url'] = $filenames[$i];
                        $argsImagenes[$i]['eventoId'] = $id;
                        $imagen = new FotosEventos($argsImagenes[$i]);
                        $imagen->guardar();
                        $imagenes[] = $imagen;
                        
                    }
                    
                
                }
                
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

        $router->render('admin/events/update',[
            'evento' => $evento,
            'alertas' => $alertas,
            'lenguaje' => $lenguaje,
            'fotosEvento' =>$fotosEvento
        ]);
    }
    
    public static function delete () {
        
        if ($_SERVER['REQUEST_METHOD']=== 'POST'){

            $id = $_POST ['id'] ??'';
            $id = filter_var($id , FILTER_VALIDATE_INT);
            $imagenes = FotosEventos::getFotosbyEvent($id);

            // TODO esto se puede optimizar para que la busqueda de las imagenes y el foreach se realice solamente el metodo de imagenes controller evitando asi dos accesos consecutivos a la base de datos

            foreach ($imagenes as $imagen){
                ImagesController::deleteEventImage($imagen->id);

            }
            $evento = Eventos::find($id);
            $resultado = $evento->eliminar();
            if ($resultado){ // Si el resultado es valido
                header('location: /admin/events?alerta=2');
            }
        }
    }

}