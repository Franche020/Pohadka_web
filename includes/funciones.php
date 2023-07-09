<?php

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

function validarFecha(string $fecha) :bool{
    $date = strtotime($fecha);
    if ($fecha === false){
        return false;
    }
    return true;
}

function resultado(string $idResultado) :string {
    $resultado = 'prueba resultado';
    return $resultado;
}

function validarORedireccionar (string $url) {
    $id = $_GET['id'];
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: {$url}");
    }
    return $id;
}

function validarTipoHabitacion (string $tipo) :bool{
    $tipos = ['room', 'van','campsite'];

    return in_array($tipo , $tipos);
}