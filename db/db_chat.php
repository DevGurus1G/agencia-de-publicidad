<?php
function getUserChats($conn, $userId) {
  $stmt = $conn->prepare(
    'SELECT c.id, c.de_usuario_id, c.para_usuario_id, c.mensaje, c.fecha_envio, 
       u.username AS de_usuario_nombre, u.imagen AS de_usuario_imagen
       FROM chat c
       JOIN usuarios u ON (c.de_usuario_id = u.id OR c.para_usuario_id = u.id) AND u.id != :userId
       WHERE (c.de_usuario_id = :userId OR c.para_usuario_id = :userId)
       AND (c.de_usuario_id, c.para_usuario_id, c.fecha_envio) IN
           (SELECT de_usuario_id, para_usuario_id, MAX(fecha_envio) AS max_fecha_envio
            FROM chat
            WHERE de_usuario_id = :userId OR para_usuario_id = :userId
            GROUP BY de_usuario_id, para_usuario_id)
       ORDER BY c.fecha_envio DESC LIMIT 1'
  );

  $stmt->bindParam(':userId', $userId);
  $stmt->execute();

  $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $chats;
}

function getChatHistoryBetweenUsers($conn, $user1Id, $user2Id) {
  $stmt = $conn->prepare(
    'SELECT c.id, c.de_usuario_id, c.para_usuario_id, c.mensaje, c.fecha_envio, u.username
    FROM chat c
    JOIN usuarios u ON c.de_usuario_id = u.id
    WHERE (c.de_usuario_id = :user1Id AND c.para_usuario_id = :user2Id)
       OR (c.de_usuario_id = :user2Id AND c.para_usuario_id = :user1Id)
    ORDER BY c.fecha_envio'
  );

  $stmt->execute([':user1Id' => $user1Id, ':user2Id' => $user2Id]);

  $chatHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Procesar los resultados para mostrar el historial de conversación
  // foreach ($chatHistory as $message) {
  //   echo '<p>';
  //   echo 'De: ' . $message['username'];
  //   echo ', Mensaje: ' . $message['mensaje'];
  //   echo ', Fecha: ' . $message['fecha_envio'];
  //   echo '</p>';
  // }
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
