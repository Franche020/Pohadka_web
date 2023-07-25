<div class="card flex-col-separacion-20">

    <h3>Login</h3>
    <?php include_once __DIR__ . '/../templates/alertasPublic.php'; ?>
<form method="POST" enctype="multipart/form-data">
    <div class="entrada">
        <label for="Email">Email:</label>
        <input type="text" id="email" name="email" value="<?php //echo $evento->nombre 
                                                            ?>" required>
    </div>
    <div class="entrada">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php //echo $evento->nombre 
                                                                    ?>" required>
    </div>
    <div class="botonera--horizontal2">
        <a href="/registration" class="boton">Create Account</a>
        <input class="boton boton-submit" type="submit" value="Login">
    </div>
    <a href="/remember" class=""> Forgot the password?</a>

</form>
</div>