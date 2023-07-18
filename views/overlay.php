<!DOCTYPE html>
<html lang="<?php echo htmlLang($lenguaje) ?>
">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pohadka <?php echo $titulo; ?></title>
    <link rel="preconnect" href="/build/css/app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/build/css/app.css">


</head>
<body class="overlay">
    <?php 
        // TODO Eliminar, se va a convertir en API
        echo $contenido;
        include_once __DIR__ .'/templates/footerEn.php'; 
    ?>
