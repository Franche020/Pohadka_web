<div class="alertas">
  <?php 
  if (!empty($alertas)){
    if ($lenguaje !== 'cs-CZ') {
      foreach($alertas['en'] as $alerta) {
      ?>
      <p class="alerta error">
        <?php echo $alerta ?>
      </p>
      <?php
      }
    }
  }
  ?>
</div>

<form method="POST" action="">
  <label for="name">Name:</label>
  <input type="text" id="nombre" name="evento[nombre]" value="<?php echo $evento->nombre?>">
  
  <label for="date">Date:</label>
  <input type="date" id="fecha" name="evento[fecha]" value="<?php echo $evento->fecha?>" pattern="\d{2}/\d{2}/\d{4}">
  
  <label for="descripcionIngles">English Description:</label>
  <textarea class="editor1" id="descripcionIngles" name="evento[descripcionIngles]" ><?php echo $evento->descripcionIngles; ?></textarea>
  
  <label for="descripcionCheco">Czech Description:</label>
  <textarea class="editor2" id="descripcionCheco" name="evento[descripcionCheco]" ><?php echo $evento->descripcionCheco; ?></textarea>
  
<?php
$script = '
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
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