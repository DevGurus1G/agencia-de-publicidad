<a href="/chat/conversation?para_usuario_id=<?
if ($usuario_conectado == $chat["para_usuario_id"])
    echo $chat["de_usuario_id"];
else
    echo $chat["para_usuario_id"]; 
?>">
    <div class="chat-card">
    <?php   if ($usuario_conectado == $chat['de_usuario_id']) {
            $base64img = base64_encode($chat['imagen_destinatario']);
            $nombre = $chat['destinatario'];
            $mensaje = "Yo: " . $chat['mensaje'];
            }else {
            $base64img = base64_encode($chat['imagen_remitente']);
            $nombre = $chat['remitente'];
            $mensaje = $nombre . ": " . $chat['mensaje'];
    }?>
        <img src="data:image/png;base64,<?= $base64img ?>" alt="">
        <div>
            <p><?= $nombre ?></p>
            <p><?= $mensaje?></p>
        </div>
        <span><?= $chat['fecha_envio'] ?></span>
    </div>
</a>