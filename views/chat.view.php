<?php include 'views/components/header.php'; ?>
<main>
    <? foreach ($chats as $chat): ?>
        <? include 'views/components/chat_card.php'; ?>
    <? endforeach; ?>
</main>

<?php include 'views/components/footer.php'; ?>
