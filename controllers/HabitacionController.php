<?php

namespace Controllers;

use Model\FotosHabitaciones;
use Model\Habitacion;
use MVC\Router;

class HabitacionController {
    
    public static function index() {
        echo'Index habitaciones';
    }

    public static function admin (Router $router) {
        $habitaciones = Habitacion::all();

        $router->render('admin/acommodation/index', [
            'habitaciones' => $habitaciones
        ]);
    }

    public static function create(Router $router) {
        $lenguaje = lenguaje(); // Obtengo el lenguaje de la web para poder pasarlo a la vista y renderizar el contenido que toque
        $alertas = Habitacion::getAlertas();
        $habitacion = new Habitacion();
        $resultado = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $habitacion = new Habitacion($_POST['habitacion']);
            $alertas = $habitacion->validar();
            
            if(!empty($_FILES)){
                $imagen = new ImagesController();
                $filenames = $imagen->uploadImage('habitacion');
                //debuguear($filenames);
            }

            if (empty($alertas)){
                $resultado = $habitacion->guardar();
                
            }
            if(!empty($filenames)) {
                for ($i = 0; $i < sizeof($filenames); $i++){
                    $argsImagenes[$i] = $_POST['fotosHabitaciones'][$i];
                    $argsImagenes[$i]['url'] = $filenames[$i];
                    $argsImagenes[$i]['habitacionId'] = $resultado['id'];
                    //debuguear($argsImagenes);
                    $imagen = new FotosHabitaciones($argsImagenes[$i]);
                    $imagen->guardar();
                }
            } 

            if($resultado){

                header('location: /admin/acommodation?alert=1');
            }
            

        }

        $router->render('admin/acommodation/create', [
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
        $fotosHabitacion = FotosHabitaciones::getFotosbyRoom($id);

        
        if(!empty($habitacion)) {
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $args = $_POST['habitacion'];
                $habitacion->sincronizar($args);
                $alertas = $habitacion->validar();

                if(!empty($_FILES)){
                    $imagen = new ImagesController();
                    $filenames = $imagen->uploadImage('habitacion');
                }

                if(!empty($filenames)) {
                    
                    for ($i = 0; $i < sizeof($filenames); $i++){
                        $argsImagenes[$i] = $_POST['fotosHabitaciones'][$i];
                        $argsImagenes[$i]['url'] = $filenames[$i];
                        $argsImagenes[$i]['habitacionId'] = $id;
                        $imagen = new FotosHabitaciones($argsImagenes[$i]);
                        $imagen->guardar();
                    }
                    
                }

                if (empty($alertas)) {
                    $habitacion->guardar();

                    header('location: /admin/acommodation?alert=3');
                }
            }
        } else {

            header('location: /admin/acommodation?error=3');
        }

        //debuguear($habitacion);
        
        $router->render('admin/acommodation/update', [
            'habitacion' => $habitacion,
            'alertas' => $alertas,
            'lenguaje' => $lenguaje,
            'fotosHabitacion' => $fotosHabitacion
        ]);
    }

    public static function delete () {
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST ['id'] ??'';
            $id = filter_var($id , FILTER_VALIDATE_INT);
            $imagenes = FotosHabitaciones::getFotosbyRoom($id);
            
            foreach($imagenes as $imagen) {
                ImagesController::deleteAcommodationImage($imagen->id);
            }

            $habitacion = Habitacion::find($id);
            $resultado = $habitacion->eliminar();
            if ($resultado){ // Si el resultado es valido
                header('location: /admin/acommodation?alert=2');
            }
        }
    }
}