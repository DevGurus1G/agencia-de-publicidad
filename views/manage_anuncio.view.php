<?php require 'views/components/header.php'; ?>
<main>
<form action="authenticate" method="post" id="registroAnuncio-form">
  <div class="configAnuncio">

      <a id="eliminarAnuncio" href="#">Eliminar</a>

      
      <div class="imagen-input" id="imagen-input">

        <div class="imagen-grupo">
        <img src="../assets/img/default_avatar.webp" id="avatar1" class="avatar"/>
          <input type="file" name="imagen1" id="imagen1" />
          <label for="imagen1">Subir</label>
        </div>

        <div class="imagen-grupo">
        <img src="../assets/img/default_avatar.webp" id="avatar2" class="avatar"/>
          <input type="file" name="imagen" id="imagen2" />
          <label for="imagen2">Subir</label>
        </div>

        <div class="imagen-grupo">
        <img src="../assets/img/default_avatar.webp" id="avatar3" class="avatar" />
          <input type="file" name="imagen" id="imagen3" />
          <label for="imagen3">Subir</label>
        </div>

      </div>

      <input type="text" placeholder="Titulo" id="tituloAnuncio"/>

      <select id="categoriaAnuncio">
      <? foreach ($categorias as $categoria) : ?>
        <option value="<?= $categoria['id'] ?>"><?= $categoria[
  'nombre'
] ?></option>
      <? endforeach; ?>
      </select>

      <textarea placeholder="Descripcion" id="descripcionAnuncio"></textarea>

      <div class="precioAnuncio">
      <input type="text" placeholder="Precio" id="precioAnuncio"/><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M15 30C23.2845 30 30 23.2845 30 15C30 6.7155 23.2845 0 15 0C6.7155 0 0 6.7155 0 15C0 23.2845 6.7155 30 15 30ZM7.125 15C7.125 14.6175 7.152 14.2425 7.2045 13.875H12C12.2984 13.875 12.5845 13.7565 12.7955 13.5455C13.0065 13.3345 13.125 13.0484 13.125 12.75C13.125 12.4516 13.0065 12.1655 12.7955 11.9545C12.5845 11.7435 12.2984 11.625 12 11.625H7.8825C8.34842 10.6418 9.01302 9.76581 9.83438 9.05228C10.6557 8.33875 11.6161 7.80316 12.6547 7.4793C13.6934 7.15543 14.788 7.05031 15.8693 7.17056C16.9507 7.29082 17.9953 7.63384 18.9375 8.178C19.0655 8.25303 19.2071 8.30201 19.3541 8.32211C19.5011 8.34221 19.6506 8.33303 19.794 8.29511C19.9375 8.25719 20.072 8.19127 20.1898 8.10115C20.3077 8.01102 20.4065 7.89848 20.4807 7.76999C20.5549 7.64151 20.603 7.49962 20.6221 7.35249C20.6412 7.20536 20.631 7.0559 20.5922 6.91272C20.5533 6.76954 20.4865 6.63546 20.3956 6.5182C20.3047 6.40095 20.1915 6.30283 20.0625 6.2295C18.7749 5.48688 17.3396 5.03674 15.8586 4.91101C14.3775 4.78527 12.8869 4.98703 11.4925 5.50197C10.0982 6.01691 8.83424 6.83241 7.79039 7.8906C6.74654 8.94879 5.94836 10.2237 5.4525 11.625H4.5C4.20163 11.625 3.91548 11.7435 3.7045 11.9545C3.49353 12.1655 3.375 12.4516 3.375 12.75C3.375 13.0484 3.49353 13.3345 3.7045 13.5455C3.91548 13.7565 4.20163 13.875 4.5 13.875H4.9365C4.85381 14.6227 4.85381 15.3773 4.9365 16.125H4.5C4.20163 16.125 3.91548 16.2435 3.7045 16.4545C3.49353 16.6655 3.375 16.9516 3.375 17.25C3.375 17.5484 3.49353 17.8345 3.7045 18.0455C3.91548 18.2565 4.20163 18.375 4.5 18.375H5.451C5.94694 19.7765 6.74531 21.0517 7.78944 22.1101C8.83358 23.1684 10.0979 23.9839 11.4926 24.4988C12.8873 25.0136 14.3783 25.2151 15.8596 25.089C17.341 24.9629 18.7764 24.5122 20.064 23.769C20.1918 23.6949 20.3038 23.5964 20.3936 23.4791C20.4834 23.3617 20.5492 23.2278 20.5872 23.0851C20.6252 22.9423 20.6347 22.7934 20.6152 22.647C20.5957 22.5005 20.5476 22.3593 20.4735 22.2315C20.3994 22.1037 20.3009 21.9917 20.1836 21.9019C20.0662 21.8121 19.9323 21.7463 19.7896 21.7083C19.6468 21.6703 19.4979 21.6608 19.3515 21.6803C19.205 21.6998 19.0638 21.7479 18.936 21.822C17.9938 22.3662 16.9492 22.7092 15.8678 22.8294C14.7865 22.9497 13.6919 22.8446 12.6532 22.5207C11.6146 22.1968 10.6542 21.6612 9.83288 20.9477C9.01152 20.2342 8.34692 19.3582 7.881 18.375H12C12.2984 18.375 12.5845 18.2565 12.7955 18.0455C13.0065 17.8345 13.125 17.5484 13.125 17.25C13.125 16.9516 13.0065 16.6655 12.7955 16.4545C12.5845 16.2435 12.2984 16.125 12 16.125H7.2045C7.15138 15.7524 7.12481 15.3764 7.125 15Z" fill="#13C1AC"/></svg>
      </div>
      

      <button type="submit" id="registroAnuncio-btn">Confirmar</button>

  </div>
</form>
</main>
<?php require 'views/components/footer.php';
?>
