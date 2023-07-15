    <fieldset>
      <legend>Room Description</legend>

      <div class="entrada">
        <label for="name">Name:</label>
        <input type="text" id="nombre" name="habitacion[nombre]" value="<?php echo $habitacion->nombre ?>">
      </div>
      <div class="entrada">
        <label for="descripcionIngles">English Description:</label>
          <textarea class="editor1" id="descripcionIngles" name="habitacion[descripcionIngles]"><?php echo $habitacion->descripcionIngles; ?></textarea>
      </div>
      <div class="entrada">
        <label for="descripcionCheco">Czech Description:</label>
          <textarea class="editor2" id="descripcionCheco" name="habitacion[descripcionCheco]"><?php echo $habitacion->descripcionCheco; ?></textarea>
      </div>
      <div class="entrada">
        <label for="capacidad">Capacity:</label>
        <input type="number" name="habitacion[capacidad]" id="capacidad" value="<?php echo $habitacion->capacidad; ?>">
      </div>
      <div class="entrada">
        <label for="precio">Price:</label>
        <input type="number" name="habitacion[precio]" id="precio" value="<?php echo $habitacion->precio; ?>">
      </div>
      <div class="entrada">
        <label for="tipo">Type</label>
        <select name="habitacion[tipo]" id="tipo">
          <option selected disabled value="">--- Select ---</option>
          <option value="room" <?php echo $habitacion->tipo === 'room' ? 'selected' : '' ?>>Room</option>
          <option value="van" <?php echo $habitacion->tipo === 'van' ? 'selected' : '' ?>>Van</option>
          <option value="campsite" <?php echo $habitacion->tipo === 'campsite' ? 'selected' : '' ?>>Campsite</option>
        </select>
      </div>
      <div class="entrada">
        <label for="tipo">If is one of the Castle Rooms (None for campsite and van)</label>
        <select name="habitacion[castillo]" id="castillo">
          <option value="0" <?php echo $habitacion->castillo === '0' ? 'selected' : '' ?>>--- None ---</option>
          <option value="1" <?php echo $habitacion->castillo === '1' ? 'selected' : '' ?>>1</option>
          <option value="2" <?php echo $habitacion->castillo === '2' ? 'selected' : '' ?>>2</option>
          <option value="3" <?php echo $habitacion->castillo === '3' ? 'selected' : '' ?>>3</option>
          <option value="4" <?php echo $habitacion->castillo === '4' ? 'selected' : '' ?>>4</option>
        </select>
      </div>
    </fieldset>
    <fieldset class="fieldImagenes">

      <legend>Images 1 (OPTIONAL) </legend>

      <div class="entrada">
        <label for="imagenes">Images Upload</label>
        <input class="imageInput" type="file" name="0" id="imagenes" accept="image/png, image/jpeg">
      </div>

      <div class="entrada">
        <label for="altIngles">Alternative Text for English</label>
        <textarea id="altIngles" name="fotosHabitaciones[0][altIngles]"></textarea>
      </div>

      <div class="entrada">
        <label for="altCheco">Alternative Text for Czech</label>
        <textarea id="altCheco" name="fotosHabitaciones[0][altCheco]"></textarea>
      </div>

    </fieldset>
    <fieldset class="fieldImagenes">

      <legend>Images 2 (OPTIONAL) </legend>

      <div class="entrada">
        <label for="imagenes">Images Upload</label>
        <input class="imageInput" type="file" name="1" id="imagenes" accept="image/png, image/jpeg">
      </div>

      <div class="entrada">
        <label for="altIngles">Alternative Text for English</label>
        <textarea id="altIngles" name="fotosHabitaciones[1][altIngles]"></textarea>
      </div>

      <div class="entrada">
        <label for="altCheco">Alternative Text for Czech</label>
        <textarea id="altCheco" name="fotosHabitaciones[1][altCheco]"></textarea>
      </div>

    </fieldset>
    <fieldset class="fieldImagenes">
      <legend>Image 3 (OPTIONAL) </legend>
      <div class="entrada">
        <label for="imagenes">Images Upload</label>
        <input class="imageInput" type="file" name="2" id="imagenes" accept="image/png, image/jpeg">
      </div>

      <div class="entrada">
        <label for="altIngles">Alternative Text for English</label>
        <textarea id="altIngles" name="fotosHabitaciones[2][altIngles]"></textarea>
      </div>

      <div class="entrada">
        <label for="altCheco">Alternative Text for Czech</label>
        <textarea id="altCheco" name="fotosHabitaciones[2][altCheco]"></textarea>
      </div>

    </fieldset>
    <fieldset class="fieldImagenes">

      <legend>Image 4 (OPTIONAL) </legend>
      <div class="entrada">
        <label for="imagenes">Images Upload</label>
        <input class="imageInput" type="file" name="3" id="imagenes" accept="image/png, image/jpeg">
      </div>

      <div class="entrada">
        <label for="altIngles">Alternative Text for English</label>
        <textarea id="altIngles" name="fotosHabitaciones[3][altIngles]"></textarea>
      </div>

      <div class="entrada">
        <label for="altCheco">Alternative Text for Czech</label>
        <textarea id="altCheco" name="fotosHabitaciones[3][altCheco]"></textarea>
      </div>

    </fieldset>

    <?php

    $script = '

    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
    <script src="/build/js/forms.min.js"></script>
    <script>
      ClassicEditor
      .create( document.querySelector( ".editor1" ) ,{removePlugins: ["CKFinderUploadAdapter", "CKFinder", "EasyImage", "Image", "ImageCaption", "ImageStyle", "ImageToolbar", "ImageUpload", "MediaEmbed"]} )
      .catch( error => {
        console.error( error );
      } );
      ClassicEditor
      .create( document.querySelector( ".editor2" )  ,{removePlugins: ["CKFinderUploadAdapter", "CKFinder", "EasyImage", "Image", "ImageCaption", "ImageStyle", "ImageToolbar", "ImageUpload", "MediaEmbed"]} )
      .catch( error => {
        console.error( error );
      } );
    </script>
    ';
