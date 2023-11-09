<?php require 'components/header.php'; ?>
<main class="anuncios">
       
        <?php foreach ($anuncios as $anuncio): ?>
            <?php require 'components/anuncio.php'; ?>
        <?php endforeach; ?>
</main>
<?php require 'components/footer.php'; ?>
