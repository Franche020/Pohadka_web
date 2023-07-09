<?php

namespace Model;

class Reservas extends ActiveRecord{
    
    protected static $tabla = 'reservas';
    protected static $columasDB = ['id', 'usuarioId', 'fecha_reserva', 'fecha_inicio', 'fecha_fin'];
    
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
}