<fieldset>
  <legend>Event Description</legend>
  <div class="entrada">
    <label for="name">Name:</label>
    <input type="text" id="nombre" name="evento[nombre]" value="<?php echo $evento->nombre ?>" required>
  </div>
  <div class="entrada">
    <label for="date">Date:</label>
    <input type="date" id="fecha" name="evento[fecha]" value="<?php echo $evento->fecha ?>" pattern="\d{2}/\d{2}/\d{4}" required>
  </div>
  <div class="entrada">
    <label for="descripcionIngles">English Description:</label>
    <textarea class="editor1" id="descripcionIngles" name="evento[descripcionIngles]"><?php echo $evento->descripcionIngles; ?></textarea>
  </div>
  <div class="entrada">
    <label for="descripcionCheco">Czech Description:</label>
    <textarea class="editor2" id="descripcionCheco" name="evento[descripcionCheco]"><?php echo $evento->descripcionCheco; ?></textarea>
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
    <textarea id="altIngles" name="fotosEventos[0][altIngles]"></textarea>
  </div>

  <div class="entrada">
    <label for="altCheco">Alternative Text for Czech</label>
    <textarea id="altCheco" name="fotosEventos[0][altCheco]"></textarea>
  </div>

  <div class="entrada">
    <label for="orden">Image Order</label>
    <input type="number" id="orden" name="fotosEventos[0][orden]">
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
    <textarea id="altIngles" name="fotosEventos[1][altIngles]"></textarea>
  </div>

  <div class="entrada">
    <label for="altCheco">Alternative Text for Czech</label>
    <textarea id="altCheco" name="fotosEventos[1][altCheco]"></textarea>
  </div>

  <div class="entrada">
    <label for="orden">Image Order</label>
    <input type="number" id="orden" name="fotosEventos[1][orden]">
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
    <textarea id="altIngles" name="fotosEventos[2][altIngles]"></textarea>
  </div>

  <div class="entrada">
    <label for="altCheco">Alternative Text for Czech</label>
    <textarea id="altCheco" name="fotosEventos[2][altCheco]"></textarea>
  </div>

  <div class="entrada">
    <label for="orden">Image Order</label>
    <input type="number" id="orden" name="fotosEventos[2][orden]">
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
    <textarea id="altIngles" name="fotosEventos[3][altIngles]"></textarea>
  </div>

  <div class="entrada">
    <label for="altCheco">Alternative Text for Czech</label>
    <textarea id="altCheco" name="fotosEventos[3][altCheco]"></textarea>
  </div>

  <div class="entrada">
    <label for="orden">Image Order</label>
    <input type="number" id="orden" name="fotosEventos[3][orden]">
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
