<?php
function getUserChats($conn, $userId) {
  $stmt = $conn->prepare(
    'SELECT c.id, c.de_usuario_id, c.para_usuario_id, c.mensaje, c.fecha_envio,
    u.username AS remitente, u.imagen AS imagen_remitente
    FROM chat c
    JOIN usuarios u ON c.de_usuario_id = u.id
    WHERE (c.de_usuario_id = :userId OR c.para_usuario_id = :userId)
    AND c.fecha_envio = (
        SELECT MAX(fecha_envio)
        FROM chat
        WHERE (de_usuario_id = :userId OR para_usuario_id = :userId)
    )
    ORDER BY c.para_usuario_id;'
  );

  $stmt->execute([':userId' => $userId]);

  $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $chats;
}

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

function getNuevosMensajes($conn, $usuario, $lastMessageId) {
  $stmt = $conn->prepare(
    'SELECT * FROM chat WHERE (de_usuario_id = :usuario OR para_usuario_id = :usuario) AND id > :lastMessageId ORDER BY fecha_envio ASC'
  );
  $stmt->execute([':usuario' => $usuario, ':lastMessageId' => $lastMessageId]);

  $newMessages = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $newMessages;
}
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
