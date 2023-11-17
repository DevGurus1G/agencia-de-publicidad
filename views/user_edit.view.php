<?php include 'views/components/header.php'; ?>

<?php $usuario = $_SESSION['usuario']?>

<main>
  <div class="userEditMenu">
    <div class="imagen-input" id="imagen-input">
    <div class="imagen-grupo">
    <?php $base64img = base64_encode($usuario['imagen']); ?>
        <img src="data:image/png;base64,<?= $base64img ?>" alt="" id="avatar">
        <input type="file" name="imagen" id="imagen"/>
        <label for="imagen">Subir</label>
      </div>
    </div>

    <form action="/register"
          method="post"
          enctype="multipart/form-data">

      <input type="text" placeholder="Nombre" id="nombreUser" value="<?echo $usuario['nombre']?>"/>

      <input type="text" placeholder="Apellidos" id="apellidosUser" value="<?echo $usuario['apellidos']?>"/>

      <input type="text" placeholder="Usuario" id="usernameUser" value="<?echo $usuario['username']?>"/>

      <input type="text" placeholder="Email" id="emailUser" value="<?echo $usuario['email']?>"/>

      <input type="password" placeholder="Contraseña Actual" id="passwordUserActual"/>

      <div class="checkbox">

        <input type="checkbox" id="cambiarPassword" name="cambiarPassword"/>
        <label for="cambiarPassword">Cambiar Contraseña</label>

      </div>

      <input type="password" placeholder="Contraseña Nueva" id="passwordUser" class="passwordField" hidden/>

      <input type="password" placeholder="Repite contraseña" id="passwordUser2" class="passwordField" hidden/>

      <input type="button" value="Confirmar" id="registroUser-btn"/>

    </form>

  </div>
  <script src="../assets/js/user_edit.js"></script>
</main>
<?php include 'views/components/footer.php';?>
