<?php require 'views/components/header.php'; ?>
<main>
  <?php foreach ($anuncios as $anuncio): ?>
  <div class="tarjeta-anuncio">
  <img src="data:image/jpeg;base64,<?= base64_encode(
    $anuncio['primera_imagen']
  ) ?>" alt="Foto del anuncio mostrado" />
    <div class="tarjeta-anuncio-texto">
      <div class="texto-cabecera">
        <h2><?= $anuncio['titulo'] ?></h2>
        <? if($tipo=="comprador"): ?>
          <a href="/user/anuncio?id=<?= $anuncio['anuncio_id'] ?>">
          <svg
            class="corazon"
            xmlns="http://www.w3.org/2000/svg"
            width="128"
            height="128"
            viewBox="0 0 48 48"
          >
            <mask id="IconifyId18bb501bdfbf28b3828">
              <path
                fill="#555"
                stroke="#fff"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="4"
                d="M15 8C8.925 8 4 12.925 4 19c0 11 13 21 20 23.326C31 40 44 30 44 19c0-6.075-4.925-11-11-11c-3.72 0-7.01 1.847-9 4.674A10.987 10.987 0 0 0 15 8Z"
              />
            </mask>
            <path
              fill="#666666"
              d="M0 0h48v48H0z"
              mask="url(#IconifyId18bb501bdfbf28b3828)"
            />
          </svg>
          </a>
          <? elseif($tipo=="tienda"): ?>
          <a href="/anuncio/manage?editar=<?= $anuncio['anuncio_id'] ?>">
          <svg
            width="36"
            height="36"
            viewBox="0 0 36 36"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M28.95 13.3875L22.575 7.0875L24.675 4.9875C25.25 4.4125 25.9565 4.125 26.7945 4.125C27.6325 4.125 28.3385 4.4125 28.9125 4.9875L31.0125 7.0875C31.5875 7.6625 31.8875 8.3565 31.9125 9.1695C31.9375 9.9825 31.6625 10.676 31.0875 11.25L28.95 13.3875ZM26.775 15.6L10.875 31.5H4.5V25.125L20.4 9.225L26.775 15.6Z"
              fill="#13C1AC"
            />
          </svg>
        </a>
        <? endif; ?>
      </div>
      <div class="texto-descripcion">
        <p><?= $anuncio['descripcion'] ?></p>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</main>
<?php require 'views/components/footer.php'; ?>
