/**
 * Elemento que contiene el carrusel de imágenes
 * @type {HTMLElement}
 */
let carrusel = document.querySelector('.carrusel');

/**
 * Índice de la imagen actual en el carrusel
 * @type {number}
 */
let imagenActual = 0;

/**
 * Total de imágenes en el carrusel
 * @type {number}
 */
let totalDeImagenes = 3;

/**
 * Botón para marcar/desmarcar como favorito
 * @type {HTMLElement}
 */
let favorito = document.querySelector('#favorito');

// Event Listeners para cambiar de imagen en el carrusel
document.getElementById('anterior').addEventListener('click', () => cambiarImagen(-1));
document.getElementById('siguiente').addEventListener('click', () => cambiarImagen(1));

/**
 * Cambia la imagen en el carrusel basado en la dirección
 * @param {number} direccion - Dirección del cambio (+1 o -1)
 * @returns {void}
 */
function cambiarImagen(direccion) {
  imagenActual += direccion;

  if (imagenActual >= totalDeImagenes) {
    imagenActual = 0;
  } else if (imagenActual < 0) {
    imagenActual = totalDeImagenes - 1;
  }

  mostrarImagen(imagenActual);
  actualizarBotones();
}

/**
 * Muestra la imagen actual en el carrusel
 * @param {number} indice - Índice de la imagen a mostrar
 * @returns {void}
 */
function mostrarImagen(indice) {
  carrusel.style.transform = `translateX(-${indice * 100}%)`;
}

/**
 * Actualiza el estado de los botones del carrusel
 * @returns {void}
 */
function actualizarBotones() {
  document.getElementById('anterior').disabled = imagenActual === 0;
  document.getElementById('siguiente').disabled = imagenActual === totalDeImagenes - 1;
}

// Listener para cuando clickan en favorito
favorito.addEventListener('click', gestionarFavorito);

/**
 * Gestiona el marcado/desmarcado del anuncio como favorito
 * @async
 * @returns {void}
 */
async function gestionarFavorito() {
  if (favorito.checked == false) {
    borrarFavorito();
  } else if (favorito.checked) {
    registrarFavorito();
  }
}

/**
 * Obtiene el ID del anuncio desde la URL
 * @returns {string | null} - ID del anuncio desde la URL
 */
function obtenerIdDesdeURL() {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get('id');
}

/**
 * Funcion que registra un anuncio como favorito
 * @async 
 * @returns {void}
 */
async function registrarFavorito() {
  const formData = new FormData();

  formData.append('anuncio', obtenerIdDesdeURL());
  formData.append('favorito', 'insertar');

  // Enviar solicitud al servidor para registrar el favorito
  try {
    const response = await fetch('/anuncio', {
      method: 'POST',
      body: formData,
    });
    if (response.ok) {
      const data = await response.text();
    }
  } catch (error) {
    console.error('Error al registrar favorito:', error);
  }
}

/**
 * Funcion que borra un anuncio de los favoritos
 * @async
 * @returns {void}
 */
async function borrarFavorito() {
  const anuncioId = obtenerIdDesdeURL();
  const formData = new FormData();

  formData.append('anuncio', anuncioId);
  formData.append('favorito', 'borrar');

  // Enviar solicitud al servidor para borrar el favorito
  try {
    const response = await fetch('/anuncio', {
      method: 'POST',
      body: formData,
    });

    if (response.ok) {
      const data = await response.text();
    } else {
      console.error('Error al borrar favorito:', response.statusText);
    }
  } catch (error) {
    console.error('Error en la solicitud para borrar favorito:', error);
  }
}
