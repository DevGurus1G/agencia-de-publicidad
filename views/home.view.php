<?php require 'components/header.php'; ?>
<main class="anuncios">
    <?php if (count($anuncios) > 0): ?>
        <?php foreach ($anuncios as $anuncio): ?>
            <?php require 'components/anuncio.php'; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay anuncios</p>
    <?php endif; ?>
</main>
<?php require 'components/footer.php'; ?>
