<?php

namespace Controllers;

use Model\Habitacion;
use Model\FotosHabitaciones;
use Model\ReservasHabitaciones;

class APIController {

    public static function rooms () {
        //debuguear($_POST);
        // TODO mejorar validacion
        $checkIn = filter_var($_POST['checkIn'], FILTER_SANITIZE_SPECIAL_CHARS);
        $checkOut = filter_var($_POST['checkOut'], FILTER_SANITIZE_SPECIAL_CHARS);
        
        $query = "
        SELECT h.castillo
        FROM reservas AS r
        JOIN reservasHabitaciones AS rh ON r.id = rh.reservaId
        JOIN habitaciones AS h ON rh.habitacionId = h.id
        WHERE (r.fecha_inicio <= '".$checkIn."' AND r.fecha_fin >= '".$checkIn."')
           OR (r.fecha_inicio <= '".$checkOut."' AND r.fecha_fin >= '".$checkOut."')
           OR (r.fecha_inicio >= '".$checkIn."' AND r.fecha_fin <= '".$checkOut."')";

           
        $resultado = ReservasHabitaciones::SQL($query);
        if(empty($resultado)) {
            $resultado = null;
            echo json_encode(['resultado'=>$resultado]);
        } else {
            echo json_encode(['resultado'=>$resultado]);
        }
    }
    public static function room () {

        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

        $habitacion = Habitacion::getRoom($id); // TODO Revisar esto tras probar con pagina controller
        $fotosHabitacion = FotosHabitaciones::getFotosbyRoom($habitacion['id']);

        $habitacion['fotosHabitacion'] = $fotosHabitacion;

        
        if(empty($habitacion)) {
            $habitacion = null;
            echo json_encode(['habitacion'=>$habitacion]);
        } else {
            echo json_encode(['habitacion'=>$habitacion]);
        }
    }
}