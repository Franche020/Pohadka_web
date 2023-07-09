<?php

namespace Model;

use DateTime;
use Model\ActiveRecord;

class Eventos extends ActiveRecord {

    protected static $tabla = 'eventos';
    protected static $columnasDB = ['id', 'nombre', 'fecha' ,'descripcionIngles', 'descripcionCheco'];

    function __construct($args =[])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->descripcionIngles = $args['descripcionIngles'] ?? '';
        $this->descripcionCheco = $args['descripcionCheco'] ?? '';
    }

    public $id;
    public $nombre;
    public $fecha;
    public $descripcionIngles;
    public $descripcionCheco;

    public function validar() :array {
        
        if($this->nombre===''){
            self::$alertas['en'][] ='The event must have a name.';
            self::$alertas['cz'][] ='Akce musí mít název.';
        }
        
        if($this->fecha==='' || !validarFecha($this->fecha)){
            self::$alertas['en'][] ='The event must have a date.';
            self::$alertas['cz'][] ='Akce musí mít datum.'; 
        }
        
        if (strlen($this->descripcionIngles) < 50 || strlen($this->descripcionIngles) > 2000){
            self::$alertas['en'][] ='The event must have an English description between 50 and 2000 characters.';
            self::$alertas['cz'][] ='Akce musí mít anglický popis o délce mezi 50 a 255 znaky.';
        }

        if (strlen($this->descripcionCheco) < 50 || strlen($this->descripcionCheco) > 2000){
            self::$alertas['en'][] ='The event must have a Czech description between 50 and 2000 characters.';
            self::$alertas['cz'][] ='Akce musí mít český popis o délce mezi 50 a 255 znaky.';
        }
        return self::$alertas;
    }

    public static function getShort() {
        $query = " SELECT id, nombre, fecha, "; 
        $query.="CONCAT(SUBSTRING(descripcionIngles, 1, 100), ' ...') AS descripcionIngles, ";
        $query.="CONCAT(SUBSTRING(descripcionCheco, 1, 100), ' ...') AS descripcionCheco";
        $query.=" FROM " . static::$tabla .  " ORDER BY id DESC";
        $resultado = self::consultarSQL($query);
        return $resultado;
        
    }
}