<?php
session_start();
require 'db/db_chat.php';
require 'db/db_connection.php';

require 'vendor/autoload.php'; // Asegúrate de ajustar la ruta según tu estructura de directorios
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

$conn = connect(
  $_ENV['HOST'],
  $_ENV['DB_NOMBRE'],
  $_ENV['USER'],
  $_ENV['USER_PASSWORD']
);

if (isset($_GET['para_usuario_id'])) {
  $chatHistory = getChatHistoryBetweenUsers(
    $conn,
    $_SESSION['usuario']['id'],
    $_GET['para_usuario_id']
  );
  $usuario = $_SESSION['usuario']['id'];
  $estilos = ['../assets/css/chat.css'];
  $scripts = ['../assets/js/chat.js'];
  $titulo = 'Chat | Gazteiz Denda';
  include 'views/chat_conversation.view.php';
}
?>
