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
<?php require 'components/footer.php'; ?>
