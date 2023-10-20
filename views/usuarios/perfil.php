<main class="card">

    <h3>User profile</h3>

    <p>Name: <span><?php echo $_SESSION['nombre']; ?></span></p>
    <p>Last Name: <span><?php echo $_SESSION['apellido']; ?></span></p>
    <p>Phone: <span><?php echo $_SESSION['telefono']; ?></span></p>
    <p>Email: <span><?php echo $_SESSION['email']; ?></span></p>

    <a href="/user-edit" class="boton">Modify Data</a>
</main>
<section class="card">
    <h3>Reservations</h3>

   
      <?php
      foreach ($reservas as $reserva) {
      ?>

        <div class="reserva">
          <p>Reservation Id: <span><?php echo s($reserva['reserva_id']); ?></span></p>
          <p>Date of Reservation: <span><?php echo s($reserva['fecha_reserva']); ?></span></p>
          <p>Check In: <span><?php echo s($reserva['fecha_inicio']); ?></span></p>
          <p>Check Out: <span><?php echo s($reserva['fecha_fin']); ?></span></p>
          <p>Acommodation Type: <span><?php echo s($reserva['habitacion_tipo']); ?></span></p>
          <p>Price per night: <span><?php echo s($reserva['habitacion_precio']); ?></span></p>
        </div>
          

        <?php
      }

        ?>

</section>