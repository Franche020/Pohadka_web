<div class="flex-col-separacion-10">
  <div class="botonera card">
    <a href="/admin" class="boton">Back</a>
    <a href="/admin/events/create" class="boton">Create Event</a>

  </div>

  <div class="tabla-eventos card">
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Date</th>
        <th>English</th>
        <th>Czech</th>
        <th>Actions</th>
      </tr>
      <?php
      foreach ($eventos as $evento) {
      ?>

        <tr>
          <td><?php echo $evento->id; ?></td>
          <td><?php echo $evento->nombre; ?></td>
          <td><?php echo $evento->fecha; ?></td>
          <td><?php echo $evento->descripcionIngles; ?></td>
          <td><?php echo $evento->descripcionCheco; ?></td>
          <td>
            <div class="botonera--vertical">
              <form method="GET" action="/admin/events/update">
                <input type="text" name="id" id="actualizar" value="<?php echo $evento->id; ?>" hidden>
                <input class="boton boton--actualizar" type="submit" value="Update">
              </form>
              <form method="POST" action="/admin/events/delete">
                <input type="text" name="id" id="eliminar" value="<?php echo $evento->id; ?>" hidden>
                <input class="boton boton--eliminar" type="submit" value="Delete">
              </form>
            </div>
          </td>

        <?php
      }

        ?>
    </table>
  </div>
</div>