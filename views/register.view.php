<?php include 'views/components/header_auth.php'; ?>
    <main>
      <div class="register">
        <div class="indicadores-paso">
          <div class="indicador indicador-activo">1</div>
          <div class="indicador">2</div>
          <div class="indicador">3</div>
        </div>
        <form
          action="/register"
          method="post"
          enctype="multipart/form-data"
        >
          <div class="resultado"></div>
          <div id="paso1" class="formulario-paso formulario-paso-activo">
            <!-- Contenido del paso 1 -->
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" />
            <input
              type="text"
              name="apellidos"
              id="apellidos"
              placeholder="Apellidos"
            />
            <!-- Botones de navegación -->
            <button type="button" id="btn-paso1">Siguiente</button>
          </div>
          <div id="paso2" class="formulario-paso">
            <!-- Contenido del paso 2 -->
            <input type="text" name="email" id="email" placeholder="Email" />
            <input
              type="text"
              name="username"
              id="username"
              placeholder="Usuario"
            />
            <input
              type="password"
              name="password"
              id="password"
              placeholder="Contraseña"
            />
            <!-- Botones de navegación -->
            <!-- Botones de navegación -->
            <button type="button" id="btn-paso2-seguir">Continuar</button>
            <button type="button" id="btn-paso2-volver">Volver</button>
          </div>
          <div id="paso3" class="formulario-paso">
            <!-- Contenido del paso 3 -->
            <div class="imagen-form">
              <img src="assets/img/default_avatar.webp" id="avatar" />
              <div>
                <input type="file" name="imagen" id="imagen" />
                <label for="imagen">Subir</label>
              </div>
            </div>
            <div class="radio">
              <label for="comprador">Comprador</label>
              <input type="radio" name="tipo" id="comprador" value="comprador" />
            </div>
            <div class="radio">
              <label for="tienda">Tienda</label>
              <input type="radio" name="tipo" id="tienda" value="tienda" />
            </div>
            <!-- Botones de navegación -->
            <button type="submit" id="registro-btn">Registrar</button>
            <button type="button" id="btn-paso3">Volver</button>
          </div>
        </form>
        <a href="/login" class="cambiar">¿Ya tienes una cuenta? Inicia sesion</a>
      </div>
      <script src="assets/js/register.js"></script>
    </main>
  </body>
</html>