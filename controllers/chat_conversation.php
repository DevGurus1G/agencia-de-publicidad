<?php

require 'db/db_chat.php';
require 'db/db_usuarios.php';
require 'utils/db_common.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

//Si no existe un usuario logueado se redirecciona a home
if (!isset($_SESSION['usuario'])) {
  header('Location: /');
  exit();
}

if (isset($_GET['getNewMessages'])) {
  obtenerNuevosMensajes($conn);
  exit();
}

if (isset($_GET['sendNewMessage'])) {
  enviarNuevoMensaje($conn);
  exit();
}

if (isset($_GET['para_usuario_id'])) {
  mostrarChat($conn);
}

function mostrarChat($conn) {
  $chatHistory = getChatHistoryBetweenUsers(
    $conn,
    $_SESSION['usuario']['id'],
    $_GET['para_usuario_id']
  );

  $usuario = $_SESSION['usuario']['id'];
  $para_usuario = getUsernameById($_GET['para_usuario_id'], $conn);

  $estilos = ['../assets/css/chat.css'];
  $titulo = 'Chat con ' . $para_usuario['username'] . ' | Gazteiz Denda';

  require 'views/chat_conversation.view.php';
}

function obtenerNuevosMensajes($conn) {
  $lastMessageId = $_GET['lastMessageId'];
  $newMessages = getNuevosMensajesConversacion(
    $conn,
    $_SESSION['usuario']['id'],
    $_GET['para_usuario_id'],
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
