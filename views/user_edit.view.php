<?php

include 'views/components/header.php'; ?>
<main>
  <div class="configPerfilMenu">
    <div class="imagen-input" id="imagen-input">
    <div class="imagen-grupo">
      <img src="../assets/img/default_avatar.webp" id="avatar" />
        <input type="file" name="imagen" id="imagen" />
        <label for="imagen">Subir</label>
      </div>
    </div>

    <input type="text" placeholder="Nombre" />

    <input type="text" placeholder="Apellidos" />

    <input type="text" placeholder="Usuario" />

    <input type="text" placeholder="Email" />

    <input type="password" placeholder="Contraseña" />

    <input type="password" placeholder="Repite contraseña" />

    <a href="#">Confirmar</a>
  </div>
</main>
<?php include 'views/components/footer.php';

?>
