<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $titulo ?></title>
    <? foreach ($estilos as $estilo) : ?>
    <link rel="stylesheet" href="<?= $estilo ?>" />
    <? endforeach; ?>
  </head>
  <body>
    <header>
      <a href="/chat">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="128"
          height="128"
          viewBox="0 0 24 24"
          class="icon"
        >
          <path
            fill="currentColor"
            d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6L6.4 19Z"
          />
        </svg>
      </a>
      <div class="info-receptor">
        <!-- Poner el nombre -->
        <img src="data:image/png;base64,
        <?= base64_encode($para_usuario['imagen']) ?>" alt="">
        <p><?= $para_usuario['username'] ?></p>
      </div>

    </header>
    <main>
      <ul class="historial-conversacion">
      <?php foreach ($chatHistory as $mensaje): ?>
        <?php $claseMensaje =
          $mensaje['de_usuario_id'] == $usuario ? 'msg-mio' : 'msg-otro'; ?>
        <li class="<?= $claseMensaje ?>" 
        data-id-mensaje="<?= $mensaje['id'] ?>">
            <?= $mensaje['mensaje'] ?>
            <span class="fecha"><?= $mensaje['fecha_envio'] ?></span>
        </li>
      <?php endforeach; ?>

      </ul>
      <form class="chat-form">
        <div class="input-container">
          <input type="text" placeholder="Escribir mensaje" name="mensaje" id="mensaje">
          <button type="submit">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="128" height="128" viewBox="0 0 24 24"><path fill="currentColor" d="M3 20v-6l8-2l-8-2V4l19 8l-19 8Z"/></svg>
          </button>
        </div>
      </form>
    </main>
    <script src="../assets/js/chat.js"></script>
  </body>
</html>
