<?php require 'components/header.php'; ?>
<main>
<div class="anuncios">
<?php if (count($anuncios) > 0): ?>
        <?php foreach ($anuncios as $anuncio): ?>
            <?php require 'components/anuncio.php'; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay anuncios</p>
    <?php endif; ?>
    </div>
    <button id="cargar-mas" type="button">
        Cargar más
        <span id="loader" class="loader"></span>
    </button>
</main>

<div class="container-dialogo">
    <div class="dialogo">
        <button type="button" class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6L6.4 19Z"/>
            </svg>
        </button>
        <p>
            Nuestro sitio web utiliza cookies para ofrecerte la mejor experiencia de usuario 
            y mejorar nuestros servicios. <br>Al hacer clic en "Aceptar cookies", aceptas el uso de todas las cookies. 
            Puedes ajustar tus preferencias de cookies en cualquier momento desde la configuración del navegador. 
            <br>
            Si deseas obtener más información sobre cómo usamos las cookies y cómo protegemos tu privacidad, 
            consulta nuestra política de cookies y privacidad.
        </p>
            <button type="button" class="aceptar">Aceptar cookies</button>
            <button type="button" class="denegar">Denegar cookies</button>
    </div>
</div>
<?php require 'components/footer.php'; ?>
