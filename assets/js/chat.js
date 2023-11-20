let ultimoIdMensajeConocido = 0;
const formulario = document.querySelector('.chat-form');
formulario.addEventListener('submit', function (event) {
  event.preventDefault();
  console.log('Formulario enviado');
  const mensajeInput = document.getElementById('mensaje');
  const mensaje = mensajeInput.value.trim();

  if (mensaje !== '') {
    enviarNuevoMensaje(mensaje);
    mensajeInput.value = '';
  }
});

async function enviarNuevoMensaje(mensaje) {
  try {
    const paraUsuarioId = obtenerParaUsuarioIdDesdeURL();
    const url = `/chat/conversation?sendNewMessage&para_usuario_id=${paraUsuarioId}`;
    const formData = new FormData();
    formData.append('mensaje', mensaje);

    const respuesta = await fetch(url, {
      method: 'POST',
      body: formData,
    });

    const nuevoMensaje = await respuesta.json();

    procesarNuevosMensajes([nuevoMensaje]);
  } catch (error) {
    console.error('Error al enviar el mensaje:', error);
  }
}

async function obtenerMensajesNuevos(ultimoIdMensaje) {
  try {
    const paraUsuarioId = obtenerParaUsuarioIdDesdeURL();
    const url = `/chat/conversation?getNewMessages&lastMessageId=${ultimoIdMensaje}&para_usuario_id=${paraUsuarioId}`;
    const respuesta = await fetch(url);
    const nuevosMensajes = await respuesta.json();

    if (nuevosMensajes.length > 0) {
      const usuario = nuevosMensajes[0].de_usuario_id;
      procesarNuevosMensajes(nuevosMensajes, usuario);
    } else {
      console.log('No hay mensajes nuevos.');
    }
  } catch (error) {
    console.error('Error al obtener mensajes nuevos:', error);
  }
}

function obtenerParaUsuarioIdDesdeURL() {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get('para_usuario_id');
}

function procesarNuevosMensajes(nuevosMensajes, usuario) {
  const historialConversacion = document.querySelector(
    '.historial-conversacion',
  );

  nuevosMensajes.forEach((mensaje) => {
    const idMensaje = mensaje.id;

    // Check if the message with the same ID already exists
    const existingMensaje = document.querySelector(
      `[data-id-mensaje="${idMensaje}"]`,
    );

    if (existingMensaje) {
      // Update the existing message if it already exists
      existingMensaje.querySelector('.fecha').textContent = mensaje.fecha_envio;
    } else {
      // Create and append a new message if it doesn't exist
      const nuevoElementoLi = document.createElement('li');
      const claseMensaje =
        mensaje.de_usuario_id === usuario ? 'msg-otro' : 'msg-mio';
      nuevoElementoLi.classList.add(claseMensaje);

      nuevoElementoLi.innerHTML = `
        ${mensaje.mensaje}
        <span class="fecha">${mensaje.fecha_envio}</span>
      `;

      nuevoElementoLi.dataset.idMensaje = idMensaje;
      historialConversacion.appendChild(nuevoElementoLi);
    }
  });

  // Update the last known message ID
  const ultimoIdMensajeElemento = document.querySelector(
    '.historial-conversacion li:last-child',
  );

  if (ultimoIdMensajeElemento && ultimoIdMensajeElemento.dataset.idMensaje) {
    const ultimoIdMensaje = parseInt(
      ultimoIdMensajeElemento.dataset.idMensaje,
      10,
    );

    if (ultimoIdMensaje > ultimoIdMensajeConocido) {
      ultimoIdMensajeConocido = ultimoIdMensaje;
    }
  }
}

setInterval(function () {
  const ultimoIdMensaje = obtenerUltimoIdMensajeConocido();
  obtenerMensajesNuevos(ultimoIdMensaje);
}, 500);

function obtenerUltimoIdMensajeConocido() {
  const ultimoIdMensajeElemento = document.querySelector(
    '.historial-conversacion li:last-child',
  );

  if (ultimoIdMensajeElemento && ultimoIdMensajeElemento.dataset.idMensaje) {
    return parseInt(ultimoIdMensajeElemento.dataset.idMensaje, 10);
  } else {
    return 0;
  }
}
