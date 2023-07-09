<?php



$lang = lenguaje();

if ($lang !== 'cs-CZ') {
    include_once __DIR__.'/layoutEn.php';
    
    
}

echo $script ?? '';
?>


</body>
</html>
