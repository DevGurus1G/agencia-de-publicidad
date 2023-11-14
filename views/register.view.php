<?php include 'views/components/header_auth.php'; ?>
    <main>
      <div class="register">
        <div class="indicadores-paso">
          <div class="indicador indicador-activo">1</div>
          <div class="indicador">2</div>
          <div class="indicador">3</div>
        </div>
        <form
          action="authenticate.php"
          method="post"
          enctype="multipart/form-data"
          id="registro-form"
        >
          <div class="resultado"></div>
          <div id="paso1" class="formulario-paso formulario-paso-activo">
            <!-- Contenido del paso 1 -->
            <input type="text" name="nombre" id="nombre-reg" placeholder="Nombre" />
            <input
              type="text"
              name="apellidos"
              id="apellidos-reg"
              placeholder="Apellidos"
            />
            <!-- Botones de navegación -->
            <button type="button" id="btn-paso1">Siguiente</button>
          </div>
          <div id="paso2" class="formulario-paso">
            <!-- Contenido del paso 2 -->
            <input type="email" name="email" id="email-reg" placeholder="Email" />
            <input
              type="text"
              name="username"
              id="username-reg"
              placeholder="Usuario"
            />
            <input
              type="password"
              name="password"
              id="password-reg"
              placeholder="Contraseña"
            />
            <!-- Botones de navegación -->
            <!-- Botones de navegación -->
            <button type="button" id="btn-paso2-seguir">Continuar</button>
            <button type="button" id="btn-paso2-volver">Volver</button>
          </div>
          <div id="paso3" class="formulario-paso">
            <!-- Contenido del paso 3 -->
            <div class="imagen-input" id="imagen-input">
              <img src="assets/img/default_avatar.webp" id="avatar" />
              <div>
                <input type="file" name="imagen" id="imagen" />
                <label for="imagen">Subir</label>
              </div>
            </div>
            <div class="radio">
              <label for="admin">Admin</label>
              <input type="radio" name="rol" id="admin" />
            </div>
            <div class="radio">
              <label for="user">User</label>
              <input type="radio" name="rol" id="user" />
            </div>
            <!-- Botones de navegación -->
            <button type="submit" id="registro-btn">Registrar</button>
            <button type="button" id="btn-paso3">Volver</button>
          </div>
        </form>
        <a href="/login" class="cambiar" id="btn-ir-login" >¿Ya tienes una cuenta? Inicia sesion</a>
      </div>
      <script src="assets/js/register_visuales.js"></script>
    </main>
  </body>
</html>