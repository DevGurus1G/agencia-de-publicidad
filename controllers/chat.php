<?php
session_start();
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
$titulo = 'Chats | Gasteiz Denda';
$estilos = ['assets/css/default.css', 'assets/css/chat.css'];
$scripts = ['assets/js/nav.js'];
$chats = getUserChats($conn, $_SESSION['usuario']['id']);
// print_r($chats);
require 'views/chat.view.php';
?>
