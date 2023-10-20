<main class="card">
    <h1>Reservation</h1>
    <p>Reservation ID:<span><?php

     echo s($reserva['id']) ?></span></p>
    <p>Name: <span><?php echo s($reserva['nombre']) ?></span></p>
    <p>Last Name: <span><?php echo s($reserva['apellido']) ?></span></p>
    <p>Check In date: <span><?php echo s($reserva['fecha_inicio']) ?></span></p>
    <p>Check Out date: <span><?php echo s($reserva['fecha_fin']) ?></span></p>
    <p>Room ID: <span><?php echo s($reserva['habitacionId']) ?></span></p>

    <p>During next days our staff will confirm reservation through mail, thanks</p>
</main>