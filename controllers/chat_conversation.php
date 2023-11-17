<?php
session_start();

require 'db/db_chat.php';
require 'db/db_connection.php';
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

$conn = connect(
  $_ENV['HOST'],
  $_ENV['DB_NOMBRE'],
  $_ENV['USER'],
  $_ENV['USER_PASSWORD']
);

if (isset($_GET['para_usuario_id'])) {
  mostrarChat($conn);
}

if (isset($_GET['getNewMessages'])) {
  obtenerNuevosMensajes($conn);
}

if (isset($_GET['sendNewMessage'])) {
  enviarNuevoMensaje($conn);
}

function mostrarChat($conn) {
  $chatHistory = getChatHistoryBetweenUsers(
    $conn,
    $_SESSION['usuario']['id'],
    $_GET['para_usuario_id']
  );

  $usuario = $_SESSION['usuario']['id'];
  $estilos = ['../assets/css/chat.css'];
  $titulo = 'Chat | Gazteiz Denda';

  require_once 'views/chat_conversation.view.php';
}

function obtenerNuevosMensajes($conn) {
  $lastMessageId = $_GET['lastMessageId'];
  $newMessages = getNuevosMensajes(
    $conn,
    $_SESSION['usuario']['id'],
    $lastMessageId
  );

  // Solo devolver la respuesta JSON, no el HTML de la vista
  header('Content-Type: application/json');
  echo json_encode($newMessages, JSON_UNESCAPED_UNICODE);
  exit();
}

function enviarNuevoMensaje($conn) {
  $paraUsuarioId = $_GET['para_usuario_id'];
  $mensaje = $_POST['mensaje'];

  $usuario = $_SESSION['usuario']['id'];
  $resultado = insertarNuevoMensaje($conn, $usuario, $paraUsuarioId, $mensaje);

  if ($resultado) {
    $nuevoMensaje = obtenerMensajePorId($conn, $conn->lastInsertId());
    echo json_encode($nuevoMensaje);
  } else {
    http_response_code(500);
    echo json_encode(['error' => 'Error al guardar el mensaje']);
  }

  exit();
}
?>
