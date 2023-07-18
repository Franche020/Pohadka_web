<?php

define('CARPETA_IMAGENES_EVENTOS', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/events/');
define('CARPETA_IMAGENES_GALERIA', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/gallery/');
define('CARPETA_IMAGENES_HABITACIONES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/rooms/');

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function lenguaje() :string {
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $idiomaPreferido = '';
        $idiomas = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        foreach ($idiomas as $idioma) {
            $idioma = strtolower($idioma);
            if (strpos($idioma, 'cs') === 0 || $idioma === 'cs-CZ') {
                $idiomaPreferido = 'cs-CZ';
            } else {
                $idiomaPreferido = $idiomas[0];
            }
        }
        return $idiomaPreferido;
    }    
}

function htmlLang(string $lenguaje) :string {
    if($lenguaje ==='cs-CZ'){
        $lang = 'cs';
    } else {
        $lang = 'en';
    }
    return $lang;
}

function validarFecha(string $fecha) :bool{
    $date = strtotime($fecha);
    if ($date === false){
        return false;
    }
    return true;
}

function resultado(string $idResultado) :string {
    $resultado = 'prueba resultado';
    return $resultado;
}

function validarORedireccionar (string $url, string $nombreVariable='id') { 
    $id = $_GET[$nombreVariable];
    $id = filter_var($_GET[$nombreVariable], FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: {$url}");
    }
    return $id;
}

function validarTipoHabitacion (string $tipo) :bool{
    $tipos = ['room', 'van','campsite'];

    return in_array($tipo , $tipos);
}

function validarInt (string $numero) :int {
    $integral = filter_var($numero, FILTER_VALIDATE_INT);
    if (!$integral) {
        $integral = 999;
    }
    return $integral;
}