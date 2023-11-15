<div class="anuncio-card">
    <!-- <?php $base64img = base64_encode($anuncio['fot1']); ?> -->
    <!-- <img src="data:image/png;base64,<?= $base64img ?>" alt=""> -->
    <div class="anuncio-card-info">
        <h2><?= $anuncio['titulo'] ?></h2>
        <p><?= $anuncio['descripcion'] ?></p>
    <!-- <span><i class="fa fa-user"></i> Publicado por: Admin</span> -->
        <a href="/anuncio?id=<?=$anuncio['id']?>">Publicado por <?= $anuncio['anunciante'] ?></a>
    </div>
</div>