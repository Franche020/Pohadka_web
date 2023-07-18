<?php

namespace Model;

use Model\ActiveRecord;

class Habitacion extends ActiveRecord{

    protected static $tabla = 'habitaciones';
    protected static $columnasDB = ['id', 'nombre', 'descripcionIngles', 'descripcionCheco', 'capacidad', 'precio', 'tipo', 'castillo'];

    public function __construct($args =[])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcionIngles = $args['descripcionIngles'] ?? '';
        $this->descripcionCheco = $args['descripcionCheco'] ?? '';
        $this->capacidad = $args['capacidad'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->tipo = $args['tipo'] ?? '';
        $this->castillo = $args['castillo'] ?? '0';
    }


    public $id;
    public $nombre;
    public $descripcionIngles;
    public $descripcionCheco;
    public $capacidad;
    public $precio;
    public $tipo;
    public $castillo;

    public function validar() :array {
        
        if($this->nombre===''){
            self::$alertas['en'][] ='The event must have a name.';
            self::$alertas['cz'][] ='Pokoj musí mít název.';
        }

        if (strlen($this->descripcionIngles) < 50 || strlen($this->descripcionIngles) > 2000){
            self::$alertas['en'][] ='The Room must have an English description between 50 and 2000 characters.';
            self::$alertas['cz'][] ='Pokoj musí mít anglický popis o délce mezi 50 a 255 znaky.';
        }
        
        if (strlen($this->descripcionCheco) < 50 || strlen($this->descripcionCheco) > 2000){
            self::$alertas['en'][] ='The Room must have a Czech description between 50 and 2000 characters.';
            self::$alertas['cz'][] ='Pokoj musí mít český popis o délce mezi 50 a 255 znaky.';
        }

        if($this->capacidad <= 0 || $this->capacidad > 20){
            self::$alertas['en'][] ='The room must have a capacity between 1 and 20 people.';
            self::$alertas['cz'][] ='Pokoj musí mít kapacitu mezi 1 a 20 osobami.';
        }

        if($this->precio <= 0){
            self::$alertas['en'][] ='The room must have a price greater than 0.';
            self::$alertas['cz'][] ='Pokoj musí mít cenu vyšší než 0.';
        }

        if (!validarTipoHabitacion($this->tipo)){
            self::$alertas['en'][] ='The room type is incorrect. If this happens again, please contact the administrator.';
            self::$alertas['cz'][] ='Typ pokoje je nesprávný. Pokud se toto stane znovu, prosím, kontaktujte správce.';
        }

        if ((int)$this->castillo < 0 || (int)$this->castillo > 4){
            self::$alertas['en'][] ='The selected room type for the castle is incorrect. If this happens again, please contact the administrator.';
            self::$alertas['cz'][] ='Vybraný typ pokoje pro zámek je nesprávný. Pokud se toto stane znovu, prosím, kontaktujte správce.';
        }

        return self::$alertas;
    }

    public static function getRoom (string $idCastillo) :array {
        $query = 'SELECT nombre, descripcionIngles, descripcionCheco, capacidad, precio, castillo, id';
        $query.=" FROM " . static::$tabla . " WHERE castillo = ".$idCastillo. " LIMIT 1";
        
        $resultado = self::SQL($query);
        $resultado = array_shift($resultado);

        return $resultado;
    }
}