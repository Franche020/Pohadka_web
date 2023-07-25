<main class="card">
    <h3>Remember password</h3>

    <form method="POST" enctype="multipart/form-data">
    <?php include_once __DIR__ . '/../templates/alertasPublic.php'; ?>
    <?php if ($tokenValido) { ?>
    <div class="entrada">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div class="botonera--horizontal2">
        <a href="/registration" class="boton">Create Account</a>
        <input class="boton boton-submit" type="submit" value="Set new Password">
    </div>
    <a href="/login" class="">Login</a>
        <?php }?>
</form>
</main> 