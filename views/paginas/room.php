<?php ?>
<div class="card">
    <h3><?php echo $habitacion->nombre ?></h3>
    <p><?php
        if ($lenguaje === 'cs-CZ') {
            echo $habitacion->descripcionCheco;
        } else {
            echo $habitacion->descripcionIngles;
        }
        ?></p>
    <?php foreach ($fotosHabitacion as $fotoHabitacion) {

    ?>
        <div class="galeria">

            <img src="/imagenes/rooms/<?php echo $fotoHabitacion->url ?>" alt="">

        </div>

    <?php
    }/*
    // * Desactivado por que igual se puede hacer con Javascript e Iframes
    // TODO eliminar se va a convertir en  API
    
    <form action="" method="GET">
        <input type="number" value="<?php echo $habitacion->id; ?>" hidden >
        <input class="boton boton--submit" type="submit" value="Select Room">
    </form>
    <form action="" method="GET">
        <input type="number" value="<?php echo $habitacion->id; ?>" hidden >
        <input class="" type="submit" value="Back">
    </form>
    */?>
</div>
