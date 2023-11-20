<a href="/chat/conversation?para_usuario_id=<?
if ($usuario_conectado == $chat["para_usuario_id"])
    echo $chat["de_usuario_id"];
else
    echo $chat["para_usuario_id"]; 
?>">
    <div class="chat-card">
        <?php $base64img = base64_encode($chat['imagen_remitente']); ?>
        <img src="data:image/png;base64,<?= $base64img ?>" alt="">
        <div>
            <p><?= $chat['remitente'] ?></p>
            <p><?= $chat['mensaje'] ?></p>
        </div>
        <span><?= $chat['fecha_envio'] ?></span>
    </div>
</a>