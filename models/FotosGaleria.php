<?php

namespace Model;

class FotosGaleria extends ActiveRecord {
    protected $tabla = 'fotosgaleria';
    protected $columasDb = ['id', 'url'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->url = $args['url'] ?? '';
    }

    public $id;
    public $url;
}