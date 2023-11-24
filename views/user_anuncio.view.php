<?php require 'views/components/header.php'; ?>
<main>
  <?php foreach($anuncios as $anuncio): ?>
  <div class="tarjeta-anuncio">
    <?php
      $imagenEncontrada = false;
      foreach ($imagenes as $imagen) {
        if ($imagen['anuncio_id'] == $anuncio['id'] && !$imagenEncontrada) {
          echo '<img src="data:image/jpeg;base64,' . base64_encode($imagen['imagen']) .'" alt="Foto del anuncio mostrado" />';
          $imagenEncontrada = true;
        }
      }
      ?>
    <div class="targe-anuncio-texto">
      <div class="texto-cabecera">
        <h2><?= $anuncio['titulo']; ?></h2>
        <? if($tipo=="comprador"): ?>
        <a href="#">
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
            <?php echo "<a href=/anuncio/manage?editar=si&id=" . $anuncio['id'] . ">" ?>
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
        <?php echo "<a href=/user/anuncio?borrar=si&id=" . $anuncio['id'] . ">" ?>
        <svg width="24" height="28" viewBox="0 0 24 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.5 0.5V2H0V5H1.5V24.5C1.5 25.2956 1.81607 26.0587 2.37868 26.6213C2.94129 27.1839 3.70435 27.5 4.5 27.5H19.5C20.2956 27.5 21.0587 27.1839 21.6213 26.6213C22.1839 26.0587 22.5 25.2956 22.5 24.5V5H24V2H16.5V0.5H7.5ZM7.5 8H10.5V21.5H7.5V8ZM13.5 8H16.5V21.5H13.5V8Z" fill="#DC3545"/></svg>

        </a>
        <? endif; ?>
      </div>
      <div class="texto-descripcion">
        <p><?= $anuncio['descripcion']; ?></p>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</main>
<?php require 'views/components/footer.php';?>
