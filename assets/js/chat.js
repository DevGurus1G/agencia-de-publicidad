/**
 * Variable para almacenar el último ID de mensaje conocido
 * @type {number}
 */
let ultimoIdMensajeConocido = 0;

// Obtener el formulario de chat y agregar un listener para el envío del mensaje
const formulario = document.querySelector('.chat-form');
formulario.addEventListener('submit', function (event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto

  // Obtener el mensaje del input y limpiar espacios en blanco al principio o final
  const mensajeInput = document.getElementById('mensaje');
  const mensaje = mensajeInput.value.trim();

  if (mensaje !== '') {
    // Enviar el nuevo mensaje si no está vacío y limpiar el input
    enviarNuevoMensaje(mensaje);
    mensajeInput.value = '';
  }
});

/**
 * Función asincrona para enviar un nuevo mensaje al servidor
 * @param {string} mensaje - Mensaje a enviar
 * @returns {Promise<void>}
 */
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

/**
 * Función asincrona para obtener mensajes nuevos desde el servidor
 * @param {number} ultimoIdMensaje - Último ID de mensaje conocido
 * @returns {Promise<void>}
 */
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

/**
 * Función para obtener el ID del usuario destino del chat desde la URL
 * @returns {string | null} - ID del usuario destinatario del chat
 */
function obtenerParaUsuarioIdDesdeURL() {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get('para_usuario_id');
}

/**
 * Función para procesar y mostrar los nuevos mensajes en el chat
 * @param {object[]} nuevosMensajes - Array de objetos con nuevos mensajes
 * @param {string} usuario - ID del usuario actual
 * @returns {void}
 */
function procesarNuevosMensajes(nuevosMensajes, usuario) {
  const historialConversacion = document.querySelector('.historial-conversacion');

  nuevosMensajes.forEach((mensaje) => {
    const idMensaje = mensaje.id;

    // Verificar si el mensaje con el mismo ID ya existe en el chat
    const existingMensaje = document.querySelector(`[data-id-mensaje="${idMensaje}"]`);

    if (existingMensaje) {
      // Actualizar el mensaje existente si ya está presente en el historial
      existingMensaje.querySelector('.fecha').textContent = mensaje.fecha_envio;
    } else {
      // Crear y agregar un nuevo mensaje si no existe en el historial
      const nuevoElementoLi = document.createElement('li');
      const claseMensaje = mensaje.de_usuario_id === usuario ? 'msg-otro' : 'msg-mio';
      nuevoElementoLi.classList.add(claseMensaje);

      nuevoElementoLi.innerHTML = `
        ${mensaje.mensaje}
        <span class="fecha">${mensaje.fecha_envio}</span>
      `;

      nuevoElementoLi.dataset.idMensaje = idMensaje;
      historialConversacion.appendChild(nuevoElementoLi);
    }
  });

  // Actualizar el ID del último mensaje conocido
  const ultimoIdMensajeElemento = document.querySelector('.historial-conversacion li:last-child');

  if (ultimoIdMensajeElemento && ultimoIdMensajeElemento.dataset.idMensaje) {
    const ultimoIdMensaje = parseInt(ultimoIdMensajeElemento.dataset.idMensaje, 10);

    if (ultimoIdMensaje > ultimoIdMensajeConocido) {
      ultimoIdMensajeConocido = ultimoIdMensaje;
    }
  }
}

/**
 * Intervalo para obtener mensajes nuevos cada 500 milisegundos
 */
setInterval(function () {
  const ultimoIdMensaje = obtenerUltimoIdMensajeConocido();
  obtenerMensajesNuevos(ultimoIdMensaje);
}, 500);

/**
 * Función para obtener el ID del último mensaje conocido en el historial de conversación
 * @returns {number} - ID del último mensaje conocido
 */
function obtenerUltimoIdMensajeConocido() {
  const ultimoIdMensajeElemento = document.querySelector('.historial-conversacion li:last-child');

  if (ultimoIdMensajeElemento && ultimoIdMensajeElemento.dataset.idMensaje) {
    return parseInt(ultimoIdMensajeElemento.dataset.idMensaje, 10);
  } else {
    return 0;
  }
}
