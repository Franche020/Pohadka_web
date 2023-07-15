<?php include_once 'alertasFormularios.php' ?>
<form class="card" method="POST">
    <fieldset class="fieldImagenes">
        <legend>Image </legend>

        <div>
            <picture>            
                    <img src="/imagenes/rooms/<?php echo $fotoHabitacion->url; ?>">
            </picture>
        </div>
        <div class="entrada">
            <label for="altIngles">Alternative Text for English</label>
            <textarea id="altIngles" name="fotosHabitacion[altIngles]"><?php echo $fotoHabitacion->altIngles; ?></textarea>
        </div>
        <div class="entrada">
            <label for="altCheco">Alternative Text for Czech</label>
            <textarea id="altCheco" name="fotosHabitacion[altCheco]"><?php echo $fotoHabitacion->altCheco; ?></textarea>
        </div>
        <input class="boton" type="submit" value="Update">
    </fieldset>  
</form>