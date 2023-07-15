

<div class="botonera card">
      <h3>Update Event</h3>
      <a href="/admin/events" class="boton">Back</a>

</div>

<div class="card flex-col-separacion-20">


<?php
include_once __DIR__ . '/../../templates/gestionImagenesEventos.php';
include_once __DIR__ . '/../../templates/alertasFormularios.php';
?>


<form method="POST"  enctype="multipart/form-data">

<?php
include_once __DIR__ . '/../../templates/formularioEventos.php';
?>

        <input class="boton boton-submit" type="submit" value="Update">
  </form>
  </div>