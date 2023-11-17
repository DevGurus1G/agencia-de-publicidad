<a href="/chat/conversation?para_usuario_id=<?= $chat['para_usuario_id'] ?>">
    <div class="chat-card">
        <?php $base64img = base64_encode($chat['de_usuario_imagen']); ?>
        <img src="data:image/png;base64,<?= $base64img ?>" alt="">
        <div>
            <p><?= $chat['de_usuario_nombre'] ?></p>
            <p><?= $chat['mensaje'] ?></p>
        </div>
        <span><?= $chat['fecha_envio'] ?></span>
    </div>
</a>