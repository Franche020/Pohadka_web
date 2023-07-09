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
    <input type="text" id="nombre" name="habitacion[nombre]" value="<?php echo $habitacion->nombre?>">

    <label for="descripcionIngles">English Description:</label>
    <textarea id="descripcionIngles" name="habitacion[descripcionIngles]" ><?php echo $habitacion->descripcionIngles; ?></textarea>

    <label for="descripcionCheco">Czech Description:</label>
    <textarea id="descripcionCheco" name="habitacion[descripcionCheco]" ><?php echo $habitacion->descripcionCheco; ?></textarea>

    <label for="capacidad">Capacity:</label>
    <input type="number" name="habitacion[capacidad]" id="capacidad" value="<?php echo $habitacion->capacidad; ?>">

    <label for="precio">Price:</label>
    <input type="number" name="habitacion[precio]" id="precio" value="<?php echo $habitacion->precio; ?>">

    <label for="tipo">Type</label>
    <select name="habitacion[tipo]" id="tipo">
        <option selected disabled value="">--- Select ---</option>
        <option value="room" <?php echo $habitacion->tipo === 'room' ? 'selected': '' ?>>Room</option>
        <option value="van" <?php echo $habitacion->tipo === 'van' ? 'selected': '' ?>>Van</option>
        <option value="campsite" <?php echo $habitacion->tipo === 'campsite' ? 'selected': '' ?>>Campsite</option>
    </select>
    <select name="habitacion[castillo]" id="tipo">
        <option value="0" <?php echo $habitacion->castillo === '0' ? 'selected': '' ?>>--- None ---</option>
        <option value="1" <?php echo $habitacion->castillo === '1' ? 'selected': '' ?>>1</option>
        <option value="2" <?php echo $habitacion->castillo === '2' ? 'selected': '' ?>>2</option>
        <option value="3" <?php echo $habitacion->castillo === '3' ? 'selected': '' ?>>3</option>
        <option value="4" <?php echo $habitacion->castillo === '4' ? 'selected': '' ?>>4</option>
    </select>
