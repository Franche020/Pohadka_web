<?php

namespace Model;

class FotosEventos extends ActiveRecord {
    
    protected static $tabla = 'fotoseventos';

    protected static $columnasDB = ['id', 'eventoId', 'url']; 

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? null;
        $this->eventoId = $args['eventoId'] ?? '';
        $this->url = $args['url'] ?? '';
    }

    public $id;
    public $eventoId;
    public $url;
}