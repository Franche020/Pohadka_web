<?php

namespace Model;

class ReservasHabitaciones extends ActiveRecord {
    
    protected static $tabla = 'reservashabitaciones';
    protected static $columnasDB = ['id', 'reservaId', 'habitacionId'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->reservaId = $args['reservaId'] ?? '';
        $this->habitacionId = $args['habitacionId'] ?? '';
    }
    public $id;
    public $reservaId;
    public $habitacionId;


    public static function getDatosReservaId ($id) {
        $query = "SELECT rh.id,rh.habitacionId, r.fecha_reserva, r.fecha_inicio, r.fecha_fin, u.nombre, u.apellido, u.email, u.telefono FROM ";
        $query .= self::$tabla;
        $query .=" AS rh JOIN reservas AS r ON rh.reservaId = r.id JOIN usuarios AS u ON r.usuarioId = u.id WHERE rh.id = ";
        $query .= $id;
        $query .= " LIMIT 1";

        $resultado = self::SQL($query);
        return $resultado;
    }

}