<main class="card">
    <h3>Remember password</h3>

    <form method="POST" enctype="multipart/form-data">
    <?php include_once __DIR__ . '/../templates/alertasPublic.php'; ?>
    
    <div class="entrada">
        <label for="Email">Email:</label>
        <input type="text" id="email" name="email" value="<?php //echo $evento->nombre 
                                                            ?>" required>
    </div>

    <div class="botonera--horizontal2">
        <a href="/registration" class="boton">Create Account</a>
        <input class="boton boton-submit" type="submit" value="Send instructions">
    </div>
    <a href="/remember" class=""> Forgot the password?</a>

</form>
</main>