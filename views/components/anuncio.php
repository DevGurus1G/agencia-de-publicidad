<div class="anuncio-card">
<?php  ?>
<img src="data:image/jpeg;base64,<?= base64_encode(
  $anuncio['primera_imagen']
) ?>" alt="Foto del anuncio mostrado" />
    <div class="anuncio-card-info">
        <h2><?= $anuncio['titulo'] ?></h2>
        <p><?= $anuncio['descripcion'] ?></p>
    <!-- <span><i class="fa fa-user"></i> Publicado por: Admin</span> -->
        <a href="/anuncio?id=<?= $anuncio['anuncio_id'] ?>">Publicado por 
        <?= $anuncio['nombre_anunciante'] ?>
        </a>
    </div>
</div>