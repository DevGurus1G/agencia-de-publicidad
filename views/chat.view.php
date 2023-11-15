<?php
$estilos = ['assets/css/default.css', 'assets/css/chat.css'];
include 'views/components/header.php';
?>
<main>
    <? foreach ($chats as $chat): ?>
        <? include 'views/components/chat_card.php'; ?>
    <? endforeach; ?>
</main>
