<header>
    <div class="navegacion">
        <a href="/">
            <h1>Pohadka</h1>
        </a>
        <div class="navegacion__boton">
            <div class="navegacion__boton--mostrar">
                <img src="/build/img/icon-menu.svg" alt="botón mostrar menu" />
            </div>
            <div class="navegacion__boton--cerrar">
                <img src="/build/img/icon-menu-close.svg" alt="botón mostrar menu" />
            </div>
        </div>
        <nav>
            <ul class="navegacion__enlaces">
                <li><a href="/" class="">Home</a></li>
                <li><a href="#discover" class=" ">About</a></li>
                <li><a href="/acommodation" class=" ">Acommodation</a></li>
                <li><a href="/events" class=" ">Events</a></li>
                <li><a href="#contact" class=" ">Contact</a></li>
                <li><a href="/gallery.html" class=" ">Gallery</a></li>
                <?php if (!isset($_SESSION['nombre'])) { ?>
                    <li><a href="/login" class=" ">Login</a></li>
                <?php } else { ?>
                    <li><a href="/user-profile">Profile</a></li>
                    <li><a href="/logout" class=" ">Logout</a></li>
                <?php }  ?>
            </ul>
        </nav>
        <div class="user">
            <?php if (isset($_SESSION['nombre'])) { ?>

                <p>Hi! <?php echo $_SESSION['nombre']; ?> Welcome to Pohadka</p>
            <?php } ?>
        </div>
    </div>
</header>