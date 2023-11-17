document.addEventListener('DOMContentLoaded', function () {
  // Conectar al servidor WebSocket
  let socket = new WebSocket('ws://localhost:8080');

  // Manejar el envío del formulario
  document.getElementById('chat-form').addEventListener('submit', function (e) {
    e.preventDefault();
    let message = document.getElementById('message-input').value;
    sendMessage(message);
    document.getElementById('message-input').value = '';
  });

  // Función para enviar mensajes al servidor WebSocket
  function sendMessage(message) {
    let data = {
      type: 'message',
      message: message,
      // Otros datos como usuario_id, para_usuario_id, etc.
    };

    socket.send(JSON.stringify(data));
  }

  // Manejar los mensajes recibidos del servidor WebSocket
  socket.onmessage = function (event) {
    let data = JSON.parse(event.data);
    // Aquí deberías manejar la lógica para mostrar el mensaje en el chat-box
    let chatBox = document.getElementById('chat-box');
    let messageElement = document.createElement('p');
    messageElement.textContent = data.message;
    chatBox.appendChild(messageElement);
  };
});
