// let ultimoIdMensajeConocido = 0;
// const formulario = document.querySelector('.chat-form');
// formulario.addEventListener('submit', function (event) {
//   event.preventDefault();
//   console.log('Formulario enviado'); // Agrega este log para verificar si el evento se está capturando
//   const mensajeInput = document.getElementById('mensaje');
//   const mensaje = mensajeInput.value.trim();
//   console.log(mensaje);

//   if (mensaje !== '') {
//     enviarMensaje(mensaje);
//     mensajeInput.value = '';
//   }
// });

// async function enviarMensaje(mensaje) {
//   console.log('Enviando mensaje:', mensaje);

//   try {
//     const paraUsuarioId = obtenerParaUsuarioIdDesdeURL();
//     const url = `/chat/conversation?sendNewMessage&para_usuario_id=${paraUsuarioId}`;
//     const formData = new FormData();
//     formData.append('mensaje', mensaje);

//     const respuesta = await fetch(url, {
//       method: 'POST',
//       body: formData, // No establezcas 'Content-Type' aquí, se configurará automáticamente
//     });

//     const nuevoMensaje = await respuesta.json();
//     console.log(nuevoMensaje);
//     procesarNuevosMensajes([nuevoMensaje]);
//   } catch (error) {
//     console.error('Error al enviar el mensaje:', error);
//   }
// }

// async function obtenerMensajesNuevos(ultimoIdMensaje) {
//   try {
//     const paraUsuarioId = obtenerParaUsuarioIdDesdeURL();
//     const url = `/chat/conversation?getNewMessages&lastMessageId=${ultimoIdMensaje}&para_usuario_id=${paraUsuarioId}`;
//     const respuesta = await fetch(url);
//     const nuevosMensajes = await respuesta.json(); // Cambia de text a json
//     console.log('MENSAJESSSSSSSSSSSSSSSS');
//     console.log(nuevosMensajes);
//     procesarNuevosMensajes(nuevosMensajes);
//   } catch (error) {
//     console.error('Error al obtener mensajes nuevos:', error);
//   }
// }

// function obtenerParaUsuarioIdDesdeURL() {
//   const urlParams = new URLSearchParams(window.location.search);
//   return urlParams.get('para_usuario_id');
// }

// function procesarNuevosMensajes(nuevosMensajes) {
//   // Obtener el contenedor de la conversación
//   const historialConversacion = document.querySelector(
//     '.historial-conversacion',
//   );

//   nuevosMensajes.forEach((mensaje) => {
//     const nuevoElementoLi = document.createElement('li');

//     const claseMensaje =
//       mensaje.de_usuario_id === usuario ? 'msg-mio' : 'msg-otro';
//     nuevoElementoLi.classList.add(claseMensaje);

//     nuevoElementoLi.innerHTML = `
//           ${mensaje.mensaje}
//           <span class="fecha">${mensaje.fecha_envio}</span>
//       `;

//     nuevoElementoLi.dataset.idMensaje = mensaje.id;

//     historialConversacion.appendChild(nuevoElementoLi);
//   });

//   const ultimoIdMensajeElemento = document.querySelector(
//     '.historial-conversacion li:last-child',
//   );
//   if (ultimoIdMensajeElemento && ultimoIdMensajeElemento.dataset.idMensaje) {
//     ultimoIdMensajeConocido = parseInt(
//       ultimoIdMensajeElemento.dataset.idMensaje,
//       10,
//     );
//   }
// }

// setInterval(function () {
//   console.log('Consultando mensajes nuevos'); // Agrega este log para verificar si la consulta periódica se ejecuta
//   const ultimoIdMensaje = obtenerUltimoIdMensajeConocido();
//   console.log('ULTIMO: ' + ultimoIdMensaje);
//   obtenerMensajesNuevos(ultimoIdMensaje);
// }, 5000);

// function obtenerUltimoIdMensajeConocido() {
//   const ultimoIdMensajeElemento = document.querySelector(
//     '.historial-conversacion li:last-child',
//   );

//   if (ultimoIdMensajeElemento && ultimoIdMensajeElemento.dataset.idMensaje) {
//     return parseInt(ultimoIdMensajeElemento.dataset.idMensaje, 10);
//   } else {
//     return 0;
//   }
// }
let ultimoIdMensajeConocido = 0;
const formulario = document.querySelector('.chat-form');
formulario.addEventListener('submit', function (event) {
  event.preventDefault();
  console.log('Formulario enviado');
  const mensajeInput = document.getElementById('mensaje');
  const mensaje = mensajeInput.value.trim();
  console.log(mensaje);

  if (mensaje !== '') {
    enviarMensaje(mensaje);
    mensajeInput.value = '';
  }
});

async function enviarMensaje(mensaje) {
  console.log('Enviando mensaje:', mensaje);

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
    console.log(nuevoMensaje);
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

    const usuario =
      nuevosMensajes.length > 0 ? nuevosMensajes[0].de_usuario_id : null;

    console.log('MENSAJESSSSSSSSSSSSSSSS');
    console.log(nuevosMensajes);
    procesarNuevosMensajes(nuevosMensajes, usuario);
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
    const nuevoElementoLi = document.createElement('li');

    const claseMensaje =
      mensaje.de_usuario_id === usuario ? 'msg-otro' : 'msg-mio';
    nuevoElementoLi.classList.add(claseMensaje);

    nuevoElementoLi.innerHTML = `
      ${mensaje.mensaje}
      <span class="fecha">${mensaje.fecha_envio}</span>
    `;

    nuevoElementoLi.dataset.idMensaje = mensaje.id;
    historialConversacion.appendChild(nuevoElementoLi);
  });

  const ultimoIdMensajeElemento = document.querySelector(
    '.historial-conversacion li:last-child',
  );
  if (ultimoIdMensajeElemento && ultimoIdMensajeElemento.dataset.idMensaje) {
    ultimoIdMensajeConocido = parseInt(
      ultimoIdMensajeElemento.dataset.idMensaje,
      10,
    );
  }
}

setInterval(function () {
  console.log('Consultando mensajes nuevos');
  const ultimoIdMensaje = obtenerUltimoIdMensajeConocido();
  console.log('ULTIMO: ' + ultimoIdMensaje);
  obtenerMensajesNuevos(ultimoIdMensaje);
}, 5000);

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
