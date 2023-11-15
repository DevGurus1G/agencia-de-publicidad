<?php
function getUserChats($conn, $userId) {
  $stmt = $conn->prepare(
    'SELECT c.id, c.de_usuario_id, c.para_usuario_id, c.mensaje, c.fecha_envio, u.username AS de_usuario_nombre, u.imagen as de_usuario_imagen
    FROM chat c
    JOIN usuarios u ON (c.de_usuario_id = u.id OR c.para_usuario_id = u.id) AND u.id != :userId
    WHERE (c.de_usuario_id = :userId OR c.para_usuario_id = :userId)
    AND c.fecha_envio = (SELECT MAX(fecha_envio) FROM chat WHERE de_usuario_id = c.de_usuario_id AND para_usuario_id = c.para_usuario_id)
    ORDER BY c.fecha_envio DESC'
  );

  $stmt->bindParam(':userId', $userId);
  $stmt->execute();

  $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $chats;
}

?>
