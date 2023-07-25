<div class="card flex-col-separacion-20">

    <h3>Create Account</h3>
    <?php include_once __DIR__.'/../templates/alertasPublic.php'; ?>


    <form method="POST" enctype="multipart/form-data">
        <div class="entrada">
            <label for="nombre">Name:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $usuario->nombre ?>" required placeholder="Name">
        </div>
        <div class="entrada">
            <label for="apellido">Last Name:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $usuario->apellido ?>" required placeholder="Last Name">
        </div>
        <div class="entrada">
            <label for="Email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $usuario->email ?>" required placeholder="Email">
        </div>
        <div class="entrada">
            <label for="telefono">Phone Number:</label>
            <input type="phone" id="telefono" name="telefono" value="<?php echo $usuario->telefono ?>" required placeholder="Phone Number">
        </div>
        <div class="entrada">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required placeholder="Password">
        </div>
        <div class="botonera--horizontal2">
            <input class="boton boton-submit" type="submit" value="Create Account">
        </div>
        <a href="/remember" class=""> Forgot the password?</a>

    </form>
</div>