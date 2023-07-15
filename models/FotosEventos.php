<?php

namespace Model;

class FotosEventos extends ActiveRecord {
    
    protected static $tabla = 'fotoseventos';

    protected static $columnasDB = ['id', 'eventoId', 'url', 'altIngles', 'altCheco', 'orden']; 

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? null;
        $this->eventoId = $args['eventoId'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->altIngles = $args['altIngles'] ?? '';
        $this->altCheco = $args['altCheco'] ?? '';
        $this->orden = $args['orden'] ?? 999;
    }

    public $id;
    public $eventoId;
    public $url;
    public $altIngles;
    public $altCheco;
    public $orden;

    public static function getFotosbyEvent($eventoId) :array { 
        $query = 'SELECT * FROM ' . self::$tabla . ' WHERE eventoId = ' .$eventoId;
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