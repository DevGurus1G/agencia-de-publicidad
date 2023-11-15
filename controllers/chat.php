<?php
include 'db/db_connection.php';
include 'db/db_chat.php';
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();
// Cargar todos los anuncios
$conn = connect(
  $_ENV['HOST'],
  $_ENV['DB_NOMBRE'],
  $_ENV['USER'],
  $_ENV['USER_PASSWORD']
);
$chats = getUserChats($conn, 1);
// print_r($chats);
require 'views/chat.view.php';
?>
