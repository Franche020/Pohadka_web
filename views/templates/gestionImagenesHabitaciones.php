<?php

foreach ($fotosHabitacion as $fotoHabitacion) { 

    ?>

    <div class="admin-imagen">
    <picture>            
                <img src="/imagenes/rooms/<?php echo $fotoHabitacion->url; ?>" alt="EN <?php echo $fotoHabitacion->altIngles; ?> CZ <?php echo $fotoHabitacion->altCheco?>">
    </picture>

    <div>
        <form action="/admin/acommodation/image/delete" method="POST">
            <input type="number" name="imagenId" id="" value="<?php echo $fotoHabitacion->id; ?>" hidden>
            <input type="number" name="alert" id="" value="true" hidden>
            <input class="boton boton--eliminar" type="submit" value="Delete Imagen">
        </form>
        <form action="/admin/acommodation/image/update" method="GET">
            <input type="number" name="imagenId" value="<?php echo $fotoHabitacion->id; ?>" hidden>
            <input type="number" name="habitacionId" value="<?php echo $fotoHabitacion->habitacionId; ?>" hidden>
            <input class="boton" type="submit" value="Update Imagen">
        </form>
    </div>
    </div>
<?php
}