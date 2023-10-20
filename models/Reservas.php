<?php

namespace Model;

class Reservas extends ActiveRecord{
    
    protected static $tabla = 'reservas';
    protected static $columnasDB = ['id', 'usuarioId', 'fecha_reserva', 'fecha_inicio', 'fecha_fin'];
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->usuarioId = $args['usuarioId'] ?? '';
        $this->fecha_reserva = $args['fecha_reserva'] ?? '';
        $this->fecha_inicio = $args['fecha_inicio'] ?? '';
        $this->fecha_fin = $args['fecha_fin'] ?? '';
    }

    public $id;
    public $usuarioId;
    public $fecha_reserva;
    public $fecha_inicio;
    public $fecha_fin;

    public static function getReservasbyUser (int $id) :array {
        $query ="SELECT r.id AS reserva_id, r.fecha_reserva, r.fecha_inicio, r.fecha_fin,
            h.tipo AS habitacion_tipo, h.precio AS habitacion_precio
            FROM reservas AS r
            JOIN reservasHabitaciones AS rh ON r.id = rh.reservaId
            JOIN habitaciones AS h ON rh.habitacionId = h.id
            WHERE r.usuarioId = " .$id;

        $resultado = self::SQL($query);

        return $resultado;
    }
}