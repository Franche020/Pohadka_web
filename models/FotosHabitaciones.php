<?php

namespace Model;

class FotosHabitaciones extends ActiveRecord {
    
    protected static $tabla = 'fotoshabitaciones';

    protected static $columnasDB = ['id', 'habitacionId', 'url', 'altIngles', 'altCheco']; 

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? null;
        $this->habitacionId = $args['habitacionId'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->altIngles = $args['altIngles'] ?? '';
        $this->altCheco = $args['altCheco'] ?? '';
    }

    public $id;
    public $habitacionId;
    public $url;
    public $altIngles;
    public $altCheco;

    public static function getFotosbyRoom($habitacionId) :array { 
        $query = 'SELECT * FROM ' . self::$tabla . ' WHERE habitacionId = ' .$habitacionId;
        $fotos = self::consultarSQL($query);
        return $fotos;
    }

    public function validar () {
        self::$alertas = [];

        if($this->altIngles===''){
            self::$alertas['en'][] ='The image needs a description in English.';
            self::$alertas['cz'][] ='Obrázek potřebuje popis v angličtině';
        }
        if($this->altCheco===''){
            self::$alertas['en'][] ='The image needs a description in Czech.';
            self::$alertas['cz'][] ='Obrázek potřebuje popis v češtině.';
        }
        return self::$alertas;
    }
}