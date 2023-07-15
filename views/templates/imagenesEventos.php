<?php include_once 'alertasFormularios.php' ?>
<form class="card" method="POST">
    <fieldset class="fieldImagenes">
        <legend>Image </legend>

        <div>
            <picture>            
                    <img src="/imagenes/events/<?php echo $fotoEvento->url; ?>">
            </picture>
        </div>
        <div class="entrada">
            <label for="altIngles">Alternative Text for English</label>
            <textarea id="altIngles" name="fotosEventos[altIngles]"><?php echo $fotoEvento->altIngles; ?></textarea>
        </div>
        <div class="entrada">
            <label for="altCheco">Alternative Text for Czech</label>
            <textarea id="altCheco" name="fotosEventos[altCheco]"><?php echo $fotoEvento->altCheco; ?></textarea>
        </div>
        <div class="entrada">
            <label for="orden">Image Order</label>
            <input id="orden" name="fotosEventos[orden]" value="<?php echo $fotoEvento->orden; ?>">
        </div>
        <input class="boton" type="submit" value="Update">
    </fieldset>  
</form>