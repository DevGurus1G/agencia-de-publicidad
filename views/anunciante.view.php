<?php include "views/components/header.php" ?>

<main>
    <div class="perfil">

    <?php $base64img = base64_encode($anunciante['imagen']); ?>
    <img src="data:image/png;base64,<?= $base64img ?>" alt="" id="avatar">

    <h2><?php echo $anunciante['username'] ?></h2><a href="/chat/conversation?para_usuario_id=<?= $anunciante['id'] ?>" class="chat">
          <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 24 24">
            <path fill="#000000" d="M9 5c-1.1 0-2 .9-2 2v14l4-4h9c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2H9M3 7c-.6 0-1 .4-1 1s.4 1 1 1h2V7H3m8 1h8v2h-8V8m-9 3c-.6 0-1 .4-1 1s.4 1 1 1h3v-2H2m9 1h5v2h-5v-2M1 15c-.6 0-1 .4-1 1s.4 1 1 1h4v-2H1Z"></path>
          </svg>
        </a>

    </div>

    </div>

    <div class="anuncios">
        <?php if (count($anuncios) > 0): ?>
            <?php foreach ($anuncios as $anuncio): ?>
                <?php require 'components/anuncio.php'; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay anuncios</p>
        <?php endif; ?>

    </div>

</main>

<?php include "views/components/footer.php" ?>