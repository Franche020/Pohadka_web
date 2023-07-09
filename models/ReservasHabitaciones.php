<?php

namespace Model;

class ReservasHabitaciones extends ActiveRecord {
    
    protected static $tabla = 'reservashabitaciones';
    protected static $columasDB = ['ID', 'reservaId', 'habitacionId'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->reservaId = $args['reservaId'] ?? '';
        $this->habitacionId = $args['habitacionId'] ?? '';
    }
    public $id;
    public $reservaId;
    public $habitacionId;
}