<div class="botonera card">
  <h3>Update Room</h3>
  <a href="/admin/acommodation" class="boton">Back</a>

</div>

<div class="card flex-col-separacion-20">

  <?php
  include_once __DIR__ . '/../../templates/gestionImagenesHabitaciones.php';
  include_once __DIR__ . '/../../templates/alertasFormularios.php';
  ?>
  <form method="POST" enctype="multipart/form-data">
    <?php
    include_once __DIR__ . '/../../templates/formularioHabitaciones.php';
    ?>
    <input class"boton-submit" type="submit" value="Update">
  </form>

</div>