<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - NombreApp</title>
    <style>
      *,
      *::before,
      *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
      }
      html,
      body {
        height: 100vh;
        background-color: #000;
      }
      body {
        display: grid;
        place-content: center;
      }
      .register {
        position: relative;
        display: flex;
        padding: 1em;
        flex-direction: column;
        min-width: 200px;
        max-width: 400px;
        height: 700px;
        max-height: 700px;
        justify-content: center;
        align-items: center;
        color: #fff;
      }

      .register form input {
        font-size: 1em;
        background-color: #0a0a0a;
        line-height: normal;
        padding: 1em;
        border-radius: 0.5em;
        border: none;
        outline: none;
        box-shadow: 0 0 0 1px hsla(0, 0%, 100%, 0.24);
        color: #fff;
      }

      .register form input:focus {
        box-shadow:
          0 0 0 1px hsla(0, 0%, 100%, 0.51),
          0 0 0 4px hsla(0, 0%, 100%, 0.24);
      }
      .register form input:hover {
        box-shadow: 0 0 0 1px hsla(0, 0%, 100%, 0.4);
      }

      .register form button {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1em;
        background-color: #fff;
        line-height: normal;
        padding: 1em;
        border-radius: 0.5em;
        border: none;
        outline: none;
      }
      .register form button:hover {
        background-color: #bfbfbf;
      }

      /* Estilos para los indicadores de pasos */
      .indicadores-paso {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .indicador {
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        width: 2em;
        height: 2em;
        border: 1px solid hsla(0, 0%, 100%, 0.24);
        border-radius: 50%;
        margin: 0 1em;
      }

      .indicador-activo {
        background-color: hsla(0, 0%, 100%, 0.24);
      }

      .formulario-paso {
        display: none;
      }

      .formulario-paso-activo {
        display: flex;
        width: 100%;
        flex-direction: column;
        gap: 1em;
      }

      .formulario-paso-activo div {
        display: flex;
        flex-direction: column;
        gap: 1em;
      }

      #paso3 input {
        box-shadow: none;
        background: none;
      }
      #paso3 {
        min-width: 200px;
        max-width: 400px;
      }
      /* Para subir la imagen */

      #imagen-input {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }

      #paso3 #imagen-input div input {
        display: none;
      }
      #paso3 #imagen-input div {
        justify-content: center;
        align-items: center;
      }
      #paso3 #imagen-input div label {
        color: #000;
        font-size: 1em;
        background-color: #fff;
        line-height: normal;
        padding: 1em;
        border-radius: 0.5em;
        width: 100%;
      }
      #paso3 #imagen-input div label:hover {
        background-color: #bfbfbf;
      }
      #paso3 #avatar {
        width: 5em;
        height: 5em;
        border-radius: 50%;
        overflow: hidden;
      }

      /* para los radios */
      .radio {
        border: 1px solid hsla(0, 0%, 100%, 0.24);
        border-radius: 0.5em;
        padding: 1em;
        flex-direction: row !important;
        justify-content: space-between;
        align-items: center;
      }

      .ir-login {
        margin-top: 1em;
        color: #fff;
        font-weight: bold;
        font-size: 0.75em;
        text-decoration: none;
      }
      .ir-login:hover {
        border-bottom: 1px solid #fff;
      }

      header {
        position: absolute;
        width: 100%;
        top: 0;
        padding: 1em;
        left: 0;
        display: flex;
        align-items: center;
        color: #fff;
        border-bottom: 1px solid #333;
      }
      header h1 {
        font-size: 1.5em;
      }
      header svg {
        width: 3em;
        height: 3em;
        margin-right: 1em;
      }

      /* Estilos login */
      .hidden {
        display: none;
      }
      .login {
        min-width: 200px;
        max-width: 400px;
        height: 700px;
        max-height: 700px;
      }
      .active, .active form {
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        gap: 1em;
      }

      .active form input {
        font-size: 1em;
        background-color: #0a0a0a;
        line-height: normal;
        padding: 1em;
        border-radius: 0.5em;
        border: none;
        outline: none;
        box-shadow: 0 0 0 1px hsla(0, 0%, 100%, 0.24);
        color: #fff;
      }
      .active form input:focus {
        box-shadow:
          0 0 0 1px hsla(0, 0%, 100%, 0.51),
          0 0 0 4px hsla(0, 0%, 100%, 0.24);
      }

      .active form button {
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: center;
        font-size: 1em;
        background-color: #fff;
        line-height: normal;
        padding: 1em;
        border-radius: 0.5em;
        border: none;
        outline: none;
      }
      .active form button:hover {
        background-color: #bfbfbf;
      }
    </style>
  </head>
  <body>
    <header>
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="icon"
        width="128"
        height="128"
        viewBox="0 0 24 24"
      >
        <path
          fill="#059669"
          d="M4 22V6h4q0-1.65 1.175-2.825T12 2q1.65 0 2.825 1.175T16 6h4v16H4Zm2-2h12V8h-2v3h-2V8h-4v3H8V8H6v12Zm4-14h4q0-.825-.588-1.413T12 4q-.825 0-1.413.588T10 6ZM6 20V8v12Z"
        />
      </svg>
      <h1>NombreApp</h1>
    </header>
    <!-- Registro -->
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
        <input type="hidden" name="tipo" value="registro" />
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
          <div clase="imagen-input" id="imagen-input">
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
      <a href="#" class="ir-login" id="btn-ir-login" >¿Ya tienes una cuenta? Inicia sesion</a>
    </div>
    <!-- Login -->
    <div class="login hidden">
      <form
        action="authenticate"
        method="post"
        id="login-form"
      >
        <input type="hidden" name="tipo" value="login" />
        <input type="text" name="email" id="email" placeholder="example@domain.com" />
        <input
          type="password"
          name="password"
          id="password"
          placeholder="Contraseña"
        />
        <button type="submit" id="login-btn">Login</button>
      </form>
      <a href="#" class="ir-login" id="btn-ir-registro" >¿Eres nuevo? Registrate</a>
    </div>
    <script src="./assets/js/authenticate_visuales.js"></script>
    <script src="./assets/js/authenticate.js"></script>
  </body>
</html>
