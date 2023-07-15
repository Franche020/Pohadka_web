<?php

foreach ($fotosEvento as $fotoEvento) { 

    ?>

    <div class="admin-imagen">
    <picture>            
                <img src="/imagenes/events/<?php echo $fotoEvento->url; ?>" alt="EN <?php echo $fotoEvento->altIngles; ?> CZ <?php echo $fotoEvento->altCheco?>">
    </picture>

    <div>
        <form action="/admin/events/image/delete" method="POST">
            <input type="number" name="imagenId" id="" value="<?php echo $fotoEvento->id; ?>" hidden>
            <input class="boton boton--eliminar" type="submit" value="Delete Imagen">
        </form>
        <form action="/admin/events/image/update" method="GET">
            <input type="number" name="imagenId" value="<?php echo $fotoEvento->id; ?>" hidden>
            <input type="number" name="eventoId" value="<?php echo $fotoEvento->eventoId; ?>" hidden>
            <input class="boton" type="submit" value="Update Imagen">
        </form>
    </div>
    </div>
<?php
}