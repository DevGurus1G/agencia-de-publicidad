<?php
// Incluir archivos relacionados con la base de datos y funciones comunes
require 'db/db_chat.php';
require 'db/db_usuarios.php';
require 'utils/db_common.php';

// Incluir el archivo para la gestión de sesiones de usuario
require 'utils/session.php';

/**
 * Redirige a la página principal si no existe un usuario logueado.
 */
if (!isset($_SESSION['usuario'])) {
  header('Location: /');
  exit();
}

/**
 * Maneja las solicitudes para obtener nuevos mensajes en la conversación.
 */
if (isset($_GET['getNewMessages'])) {
  obtenerNuevosMensajes($conn);
  exit();
}

/**
 * Maneja las solicitudes para enviar un nuevo mensaje.
 */
if (isset($_GET['sendNewMessage'])) {
  enviarNuevoMensaje($conn);
  exit();
}

/**
 * Muestra la conversación entre el usuario actual y otro usuario específico.
 */
if (isset($_GET['para_usuario_id'])) {
  mostrarChat($conn);
}

/**
 * Muestra la conversación entre el usuario actual y otro usuario específico.
 *
 * @param PDO $conn La conexión a la base de datos.
 * @return void
 */
function mostrarChat($conn) {
  $chatHistory = getChatHistoryBetweenUsers(
    $conn,
    $_SESSION['usuario']['id'],
    $_GET['para_usuario_id']
  );

  $usuario = $_SESSION['usuario']['id'];
  $para_usuario = getUsernameById($_GET['para_usuario_id'], $conn);

  /**
   * Estilos para la página de la conversación del chat.
   *
   * @var array $estilos
   */
  $estilos = ['../assets/css/chat.css'];

  /**
   * Título de la página de la conversación del chat.
   *
   * @var string $titulo
   */
  $titulo = 'Chat con ' . $para_usuario['username'] . ' | Gazteiz Denda';

  // Incluir la vista correspondiente para la conversación del chat
  require 'views/chat_conversation.view.php';
}

/**
 * Obtiene nuevos mensajes en la conversación y los devuelve como respuesta JSON.
 *
 * @param PDO $conn La conexión a la base de datos.
 * @return void
 */
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

/**
 * Envía un nuevo mensaje y devuelve la respuesta como JSON.
 *
 * @param PDO $conn La conexión a la base de datos.
 * @return void
 */
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
