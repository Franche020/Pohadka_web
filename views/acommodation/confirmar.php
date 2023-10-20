<main class="card">
    <h3>Confirmation</h3>
    <form method="POST">
        <fieldset>
    <p>Please review that the dates and accommodation type are correct.
        <?php if (!isset($_SESSION['nombre'])) { ?>Please complete the form below so we can process your reservation.<?php } ?></p>
    <p>Check In date: <span><?php echo s($reserva->fecha_inicio) ?></span></p>
    <p>Check Out date: <span><?php echo s($reserva->fecha_fin) ?></span></p>
    <p>Acommodation type: <span><?php echo s($tipo) ?></span></p>

            <?php if (!isset($_SESSION['nombre'])) { ?>
                <?php include_once __DIR__ . '/../templates/alertasPublic.php'; ?>

                <div class="entrada">
                    <label for="nombre">Name:</label>
                    <input type="text" id="nombre" name="usuario[nombre]" value="<?php echo isset($usuario->nombre) ? s($usuario->nombre):''; ?>" required placeholder="Name">
                </div>
                <div class="entrada">
                    <label for="apellido">Last Name:</label>
                    <input type="text" id="apellido" name="usuario[apellido]" value="<?php echo isset($usuario->apellido) ? s($usuario->apellido):''; ?>" required placeholder="Last Name">
                </div>
                <div class="entrada">
                    <label for="Email">Email:</label>
                    <input type="text" id="email" name="usuario[email]" value="<?php echo isset($usuario->email) ? s($usuario->email):''; ?>" required placeholder="Email">
                </div>
                <div class="entrada">
                    <label for="telefono">Phone Number:</label>
                    <input type="phone" id="telefono" name="usuario[telefono]" value="<?php echo isset($usuario->telefono) ? s($usuario->telefono):''; ?>" required placeholder="Phone Number">
                </div>

            <?php } else { ?>
                <p>Name: <span><?php echo s($_SESSION['nombre']) ?></span></p>
                <p>Last Name: <span><?php echo s($_SESSION['apellido']) ?></span></p>
                <p>Email: <span><?php echo s($_SESSION['email']) ?></span></p>
                <p>Telefono: <span><?php echo s($_SESSION['telefono']) ?></span></p>

            <?php } ?>
            <div class="botonera--horizontal2">
                <input class="boton boton-submit" type="submit" value="Send Reservation">
                <a class="boton retroceder--confirmar" href="">Back</a>
            </div>
        </fieldset>
    </form>
</main>
<?php
$script = '<script src="/build/js/back.min.js"></script>';