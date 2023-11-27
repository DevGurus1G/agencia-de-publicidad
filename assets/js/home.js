/**
 * Elementos del HTML seleccionados.
 * @type {HTMLElement}
 */
const btnCargarMas = document.getElementById('cargar-mas');
const loader = document.getElementById('loader');

/**
 * Variable que almacena el último anuncio cargado.
 * @type {HTMLElement}
 */
let anuncio;

/**
 * Listener para cargar más anuncios al hacer clic en el botón
 * @listens submit
 * @param {Event} e - Evento de submit del formulario.
 */
btnCargarMas.addEventListener('click', async () => {
  // Buscar el último anuncio cargado
  anuncio = document.querySelector('.anuncios .anuncio-card:last-of-type');

  if (anuncio) {
    let fechaCreado = anuncio.getAttribute('data-fecha-creado');
    console.log('FECHA: ' + fechaCreado);
    // Cargar más anuncios basados en la fecha del último anuncio
    await cargarMasAnuncios(fechaCreado);
  }
});

/**
 * Función asincrónica para cargar más anuncios.
 * @async
 * @param {string} fechaCreado - Fecha de creación del último anuncio cargado.
 */
async function cargarMasAnuncios(fechaCreado) {
  // Mostrar la animacion de carga mientras se cargan los anuncios
  showLoader();
  try {
    const response = await fetch(`/?cargar-mas=${fechaCreado}`);
    if (response.ok) {
      const data = await response.json();
      // Mostrar los nuevos anuncios cargados
      mostrarAnunciosCargados(data);
      // Actualizar la referencia al último anuncio cargado
      anuncio = document.querySelector('.anuncios .anuncios-card:last-of-type');
    }
  } catch (error) {
    // Manejar errores en la solicitud
  } finally {
    // Cuando todo acaba dejar de mostrar la animacion de carga
    hideLoader();
  }
}

/**
 * Función para mostrar los anuncios cargados.
 * @async
 * @param {Array} anuncios - Array de anuncios a mostrar.
 */
async function mostrarAnunciosCargados(anuncios) {
  let cadena = '';

  for (const anuncio of anuncios) {
    // Crear el HTML para cada anuncio
    cadena += `<div class='anuncio-card' data-fecha-creado='${anuncio.creado}' data-id='${anuncio.primera_imagen_id}'>`;
    cadena += `<a href="/anuncio?id=${anuncio.anuncio_id}" class="enlace-anuncio-card">`;

    // Obtener la imagen del anuncio
    try {
      const response = await fetch(`/?img=${anuncio.primera_imagen_id}`);

      if (response.ok) {
        const imgBase64 = await response.text();
        cadena += `<img src="data:image/jpeg;base64,${imgBase64}" alt="Foto del anuncio mostrado" />`;
      } else {
        console.error('Error en la respuesta del servidor:', response.status, response.statusText);
      }
    } catch (error) {
      console.error('Error al cargar la imagen:', error);
    }

    // Contenido del anuncio
    cadena += `<div class="anuncio-card-info">`;
    cadena += `<h2>${anuncio.titulo}</h2>`;
    cadena += `<p>${anuncio.descripcion}</p>`;
    cadena += `<a href="/anunciante?id=${anuncio.anunciante}"><span>Publicado por ${anuncio.nombre_anunciante}</span></a>`;
    cadena += `</div>`;

    cadena += `</a>`;
    cadena += `</div>`;
  }

  // Agregar los anuncios al contenedor
  document.querySelector('.anuncios').appendChild(document.createRange().createContextualFragment(cadena));
}

/**
 * Función para mostrar la animación de carga.
 */
function showLoader() {
  loader.style.display = 'inline-block';
  btnCargarMas.disabled = true;
}

/**
 * Función para ocultar la animación de carga.
 */
function hideLoader() {
  loader.style.display = 'none';
  btnCargarMas.disabled = false;
}

// Gestión de cookies
let aceptado = localStorage.getItem('cookieAceptado');
let cDialogo = document.querySelector('.container-dialogo');

if (aceptado === null) {
  // Mostrar el diálogo de aceptación de cookies si no se ha aceptado o rechazado antes
  cDialogo.classList.toggle('active');
}

// Listeners para el diálogo de cookies
let btnAceptarCookie = document.querySelector('.dialogo .aceptar');
let btnDenegarCookie = document.querySelector('.dialogo .denegar');
let btnCerrar = document.querySelector('.dialogo .icon');

btnAceptarCookie.addEventListener('click', () => {
  localStorage.setItem('cookieAceptado', true);
  cDialogo.classList.remove('active');
});

btnDenegarCookie.addEventListener('click', () => {
  localStorage.setItem('cookieAceptado', false);
  cDialogo.classList.remove('active');
});

btnCerrar.addEventListener('click', () => {
  cDialogo.classList.remove('active');
});
