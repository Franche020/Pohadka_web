<?php

namespace Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Model\FotosEventos;
use Model\FotosHabitaciones;
use MVC\Router;

class ImagesController
{

    public function uploadImage(string $tipo = 'galeria'): array
    {
        $arrayNames = [];
        //debuguear($_FILES);

        if ($tipo === 'evento') {
            $targetDir = CARPETA_IMAGENES_EVENTOS; // Directorio donde se guardarán las imágenes
        } else if ($tipo === 'galeria') {
            $targetDir = CARPETA_IMAGENES_GALERIA; // Directorio donde se guardarán las imágenes
        } else if ($tipo === 'habitacion') {
            $targetDir = CARPETA_IMAGENES_HABITACIONES; // Directorio donde se guardarán las imágenes
        }

        if (!is_dir($targetDir)) {
            clearstatcache();
            mkdir($targetDir);
        }
        foreach ($_FILES as $imagen) {

            if (!empty($imagen['name'])) {

                $uploadedFile = $imagen['tmp_name'];
                //debuguear($uploadedFile);
                $fileName = md5(uniqid(rand(), true)) . ".jpg";
                $targetPath = $targetDir . $fileName;

                $image = Image::make($uploadedFile);
                $image->fit(800, 600);

                $image->save($targetPath);
                //debuguear($_FILES);

                $image = '';

                $arrayNames[] = $fileName;
            }
        }
        return $arrayNames;
    }

    public static function deleteEventImage($id = '')
    {
        // TODO ver posibilidad de hacerlo para evento o galeria
        $id = $_POST['imagenId'] ?? $id;
        $id = filter_var($id, FILTER_VALIDATE_INT);

        $imagen = FotosEventos::find($id);
        if (file_exists(CARPETA_IMAGENES_EVENTOS . $imagen->url)) {

            unlink(CARPETA_IMAGENES_EVENTOS . $imagen->url);
        }

        $resultado = $imagen->eliminar();

        if ($resultado) { // Si el resultado es valido
            $redireccion = 'location: ' . ($_SERVER['HTTP_REFERER']) . '&alerta=5';
            header($redireccion);
        }
    }

    public static function deleteAcommodationImage($id = '')
    {

        $id = $_POST['imagenId'] ?? $id;
        $id = filter_var($id, FILTER_VALIDATE_INT);

        $imagen = FotosHabitaciones::find($id);
        if (file_exists(CARPETA_IMAGENES_HABITACIONES . $imagen->url)) {

            unlink(CARPETA_IMAGENES_HABITACIONES . $imagen->url);
        }

        $resultado = $imagen->eliminar();

        if ($resultado) { // Si el resultado es valido
            $redireccion = 'location: ' . ($_SERVER['HTTP_REFERER']) . '&alerta=5';
            header($redireccion);
        }
    }


    // TODO ELIMINAR UN EVENTO CON SUS IMAGENES ??? testear



    public static function updateEventImage(Router $router)
    {
        $alertas = [];

        $lenguaje = lenguaje();
        $id = validarORedireccionar($_SERVER['HTTP_REFERER'], 'imagenId');
        $eventId = validarORedireccionar($_SERVER['HTTP_REFERER'], 'eventoId');

        $refUrl = '/admin/events/update?id=' . $eventId;
        $fotoEvento = FotosEventos::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $fotoEvento->sincronizar($_POST['fotosEventos']);
            $alertas = $fotoEvento->validar();

            if (empty($alertas)) {
                $referer = 'location: ' . $refUrl . '&alerta=3';
                $resultado = $fotoEvento->guardar();
                if ($resultado) {

                    header($referer);
                }
            }
        }



        $router->render('/templates/imagenesEventos', [
            'fotoEvento' => $fotoEvento,
            'alertas' => $alertas,
            'lenguaje' => $lenguaje
        ]);
    }

    public static function updateAcommodationImage(Router $router)
    {
        $alertas = [];

        $lenguaje = lenguaje();
        $id = validarORedireccionar($_SERVER['HTTP_REFERER'], 'imagenId');
        $habitacionId = validarORedireccionar($_SERVER['HTTP_REFERER'], 'habitacionId');

        $refUrl = '/admin/acommodation/update?id=' . $habitacionId;
        $fotoHabitacion = FotosHabitaciones::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fotoHabitacion->sincronizar($_POST['fotosHabitacion']);
            $alertas = $fotoHabitacion->validar();

            if (empty($alertas)) {
                $referer = 'location: ' . $refUrl . '&alerta=3';
                $resultado = $fotoHabitacion->guardar();
                if ($resultado) {

                    header($referer);
                }
            }
        }

        $router->render('/templates/imagenesHabitaciones', [
            'fotoHabitacion' => $fotoHabitacion,
            'alertas' => $alertas,
            'lenguaje' => $lenguaje
        ]);
    }
}
