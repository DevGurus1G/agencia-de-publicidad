<div class="anuncio-card" data-fecha-creado="<?= $anuncio['creado'] ?>" >
    <a href="/anuncio?id=<?= $anuncio[
      'anuncio_id'
    ] ?>" class="enlace-anuncio-card">
        <img src="data:image/jpeg;base64,<?= base64_encode(
          $anuncio['primera_imagen']
        ) ?>" alt="Foto del anuncio mostrado" />
        <div class="anuncio-card-info">
            <h2><?= $anuncio['titulo'] ?></h2>
            <p><?= $anuncio['descripcion'] ?></p>
            <a href="/anunciante?id=<?= $anuncio[
              'anunciante'
            ] ?>"><span>Publicado por <?= $anuncio[
  'nombre_anunciante'
] ?></span></a>
        </div>
    </a>
</div>