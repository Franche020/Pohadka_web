<div class="contenedor acommodation">
    <section class="card">
        <h3>Acommodation options</h3>
        <p>Experience a vibrant stay in our four uniquely colored rooms. Each room is thoughtfully decorated to create a cozy and lively atmosphere. For accommodation options, choose from our charming cottages, comfortable tents, or bring your own RV. Enjoy the beauty of nature, modern amenities, and a warm campsite community for an unforgettable getaway.</p>
        <picture class="acommodation__imagen">
            <source srcset="build/img/room1.webp" type="image/webp">                
            <img src="build/img/room1.jpg" alt="Imagen de un vocalista del Festival">
        </picture>
    </section>

    <main class="card" id='main'>
        <h3>Select your Acommodation</h3>
        <?php include_once __DIR__ . '/../templates/formularioFechas.php'; ?>
        <fieldset>
            <label>Here you can choose one room</label>
            <?php include_once __DIR__ . '/../templates/mapa.php'; ?>

        </fieldset>

        <fieldset>

            <label>Or we have other options</label>

            <?php include_once __DIR__ . '/../templates/form-camp-van.php'; ?>
            <input id="acommodation-submit" class="boton boton--ancho" type="submit" value="Continue">
            </form>
    </main>
</div>

<?php $script = '<script src="/build/js/fechas.min.js"></script>,
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
