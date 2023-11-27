<?php
/**
 * Obtiene los chats del usuario.
 *
 * @param PDO      $conn   La conexión a la base de datos.
 * @param int      $userId El ID del usuario.
 * @return array Un array con la información de los chats del usuario.
 */
function getUserChats($conn, $userId) {
  $stmt = $conn->prepare(
    'SELECT
    c.id AS mensaje_id,
    c.mensaje,
    c.fecha_envio,
    remitente.username AS remitente,
    destinatario.username AS destinatario,
    remitente.imagen AS imagen_remitente,
    destinatario.imagen AS imagen_destinatario, c.para_usuario_id, c.de_usuario_id
FROM
    chat c
JOIN
    usuarios remitente ON c.de_usuario_id = remitente.id
JOIN
    usuarios destinatario ON c.para_usuario_id = destinatario.id
JOIN (
    SELECT
        MAX(fecha_envio) AS max_fecha,
        CASE
            WHEN de_usuario_id = :userId THEN para_usuario_id
            ELSE de_usuario_id
        END AS otro_usuario_id
    FROM
        chat
    WHERE
        de_usuario_id = :userId OR para_usuario_id = :userId
    GROUP BY
        otro_usuario_id
) AS ultimos_mensajes ON (
    (c.de_usuario_id = :userId AND c.para_usuario_id = ultimos_mensajes.otro_usuario_id)
    OR (c.para_usuario_id = :userId AND c.de_usuario_id = ultimos_mensajes.otro_usuario_id)
) AND c.fecha_envio = ultimos_mensajes.max_fecha
ORDER BY
    c.fecha_envio DESC;
'
  );

  $stmt->execute([':userId' => $userId]);

  $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $chats;
}

/**
 * Obtiene el historial de chat entre dos usuarios.
 *
 * @param PDO $conn    La conexión a la base de datos.
 * @param int $user1Id El ID del primer usuario.
 * @param int $user2Id El ID del segundo usuario.
 * @return array Un array con el historial de chat entre los dos usuarios.
 */
function getChatHistoryBetweenUsers($conn, $user1Id, $user2Id) {
  $stmt = $conn->prepare(
    'SELECT *
     FROM chat
     WHERE (de_usuario_id = :user1Id AND para_usuario_id = :user2Id) OR (de_usuario_id = :user2Id AND para_usuario_id = :user1Id)
     ORDER BY fecha_envio;
    '
  );

  $stmt->execute([':user1Id' => $user1Id, ':user2Id' => $user2Id]);

  $chatHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $chatHistory;
}

/**
 * Obtiene los nuevos mensajes en una conversación desde un mensaje específico.
 *
 * @param PDO $conn           La conexión a la base de datos.
 * @param int $user1Id        El ID del primer usuario.
 * @param int $user2Id        El ID del segundo usuario.
 * @param int $lastMessageId  El ID del último mensaje recibido.
 * @return array Un array con los nuevos mensajes en la conversación.
 */
function getNuevosMensajesConversacion(
  $conn,
  $user1Id,
  $user2Id,
  $lastMessageId
) {
  $stmt = $conn->prepare(
    'SELECT * FROM chat 
     WHERE ((de_usuario_id = :user1Id AND para_usuario_id = :user2Id) OR (de_usuario_id = :user2Id AND para_usuario_id = :user1Id))
       AND id > :lastMessageId 
     ORDER BY fecha_envio ASC'
  );
  $stmt->execute([
    ':user1Id' => $user1Id,
    ':user2Id' => $user2Id,
    ':lastMessageId' => $lastMessageId,
  ]);

  $newMessages = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $newMessages;
}

/**
 * Inserta un nuevo mensaje en el chat.
 *
 * @param PDO   $conn          La conexión a la base de datos.
 * @param int   $deUsuarioId   El ID del usuario que envía el mensaje.
 * @param int   $paraUsuarioId El ID del usuario que recibe el mensaje.
 * @param string $mensaje       El contenido del mensaje.
 * @return bool True si la inserción es exitosa, false en caso contrario.
 */
function insertarNuevoMensaje($conn, $deUsuarioId, $paraUsuarioId, $mensaje) {
  try {
    $query = "INSERT INTO chat (de_usuario_id, para_usuario_id, mensaje, fecha_envio) 
                VALUES (:de_usuario_id, :para_usuario_id, :mensaje, CURRENT_TIMESTAMP)";

    $stmt = $conn->prepare($query);

    $stmt->execute([
      ':de_usuario_id' => $deUsuarioId,
      ':para_usuario_id' => $paraUsuarioId,
      ':mensaje' => $mensaje,
    ]);

    return true;
  } catch (PDOException $e) {
    return false;
  }
}

/**
 * Obtiene un mensaje por su ID.
 *
 * @param PDO $conn      La conexión a la base de datos.
 * @param int $mensajeId El ID del mensaje.
 * @return array|bool Un array con la información del mensaje o false si no se encuentra.
 */
function obtenerMensajePorId($conn, $mensajeId) {
  try {
    $query = 'SELECT * FROM chat WHERE id = :id';
    $stmt = $conn->prepare($query);
    $stmt->execute([':id' => $mensajeId]);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado;
  } catch (PDOException $e) {
    return false;
  }
}

?>
