<form id="form-fecha" <?php // action="/api/rooms" method="POST"?> >
<fieldset>
  <div class="entrada">
    <label for="checkin">Date of Check-In</label>
    <input type="date" id="checkin" name="checkIn" value="" required min="<?php echo date('Y-m-d'); ?>">
  </div>
  <div class="entrada">
    <label for="checkout">Date of Check-Out:</label>
    <input type="date" id="checkout" name="checkOut" value="" required min="<?php echo date('Y-m-d'); ?>">
  </div>
    <input type="text" name="habitaciones" id="habitaciones" hidden>
    <?php //<input type="submit" value="enviar" > 
    ?>

</fieldset>
