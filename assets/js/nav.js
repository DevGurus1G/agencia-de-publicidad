/**
 * Elementos del HTML seleccionados.
 * @type {HTMLElement}
 */
const modo = document.querySelector('.modo');
const menuToggle = document.querySelector('.menu-toggle');
const menuFilter = document.querySelector('.menu-filter');
const navMenu = document.querySelector('.navMenu');
const navFilter = document.querySelector('.navFilter');

/**
 * Listener para el evento 'click' en el menú.
 * @listens click
 */
menuToggle.addEventListener('click', function () {
  // Funcionalidad para mostrar el menu y ocultar el filtro
  navMenu.classList.toggle('show');
  if (navFilter.classList.contains('show')) {
    navFilter.classList.remove('show');
  }
});

/**
 * Listener para el evento 'click' en el filtro del nav.
 * @listens click
 */
menuFilter.addEventListener('click', function () {
  // Funcionalidad para mostrar el filtro y ocultar el menu
  navFilter.classList.toggle('show');
  if (navMenu.classList.contains('show')) {
    navMenu.classList.remove('show');
  }
});

/**
 * Listener para el evento 'click' en el modo de visualización.
 * @listens click
 */
modo.addEventListener('click', function () {
  //Funcionalidad para cambiar el modo de visualizacion y guardarlo en cookies si el usuario las acepta
  document.querySelector('body').classList.toggle('dark');
  if (cookieAceptado()) {
    let modo;
    let fechaExpiracion = new Date();
    // Añade 3 meses en milisegundos (3 meses * 30 días * 24 horas * 60 minutos * 60 segundos * 1000 milisegundos)
    fechaExpiracion.setTime(
      fechaExpiracion.getTime() + 3 * 30 * 24 * 60 * 60 * 1000,
    );
    fechaExpiracion = fechaExpiracion.toUTCString();
    document.body.classList.contains('dark') ? (modo = 'dark') : (modo = 'light');
    document.cookie = 'modo=' + modo + '; expires=' + fechaExpiracion + '; path=/';
  }
});

/**
 * Verifica si se ha aceptado la cookie.
 * @returns {boolean} Devuelve true si la cookie ha sido aceptada.
 */
function cookieAceptado() {
  let aceptado = localStorage.getItem('cookieAceptado');
  if (aceptado == null){
    aceptado = false;
  }
  return aceptado;
}

// Variables para la busqueda
/**
 * Elemento de entrada del formulario de búsqueda.
 * @type {HTMLInputElement}
 */
const searchFormInput = document.querySelector('#form-search input');
let searchTimeout;

/**
 * Listener para el evento 'input' en la búsqueda.
 * @listens input
 */
searchFormInput.addEventListener('input', () => {
  clearTimeout(searchTimeout);
  searchTimeout = setTimeout(search, 1000);
});

/**
 * Función asincrona para realizar una búsqueda en el servidor.
 * @async
 * @returns {Promise<void>} Una promesa sin valor de retorno.
 */
async function search() {
  try {
    const response = await fetch(
      `/?search=${searchFormInput.value.toLowerCase().trim()}&desde_cliente`,
    );
    if (response.ok) {
      const data = await response.json();
      if(obtenerParametrosDesdeURL() == 0){
        mostrarAnunciosBuscados(data);
      }
    } else {
      console.error(
        'Error en la respuesta del servidor:',
        response.status,
        response.statusText,
      );
    }
  } catch (error) {
    console.error('Error al realizar la búsqueda:', error);
  }
}

/**
 * Función asincrona para mostrar los anuncios buscados con sus imágenes.
 * @async
 * @param {Array} anuncios - Array de anuncios a mostrar.
 * @returns {Promise<void>} Una promesa sin valor de retorno.
 */
async function mostrarAnunciosBuscados(anuncios) {
  const anunciosContenedor = document.querySelector('.anuncios');

  // Limpiar el contenido anterior
  anunciosContenedor.innerHTML = '';

  for (const anuncio of anuncios) {
    const divAnuncio = document.createElement('div');
    divAnuncio.classList.add('anuncio-card');
    divAnuncio.setAttribute('data-fecha-creado', anuncio.creado);
    divAnuncio.setAttribute('data-id', anuncio.primera_imagen_id);

    const enlaceAnuncio = document.createElement('a');
    enlaceAnuncio.href = `/anuncio?id=${anuncio.anuncio_id}`;
    enlaceAnuncio.classList.add('enlace-anuncio-card');

    // Recogida y mostrado de imagen de bbdd
    try {
      const response = await fetch(`/?img=${anuncio.primera_imagen_id}`);
      if (response.ok) {
        const imgBase64 = await response.text();
        const imgElement = document.createElement('img');
        imgElement.src = `data:image/png;base64,${imgBase64}`;
        imgElement.alt = 'Foto del anuncio mostrado';
        enlaceAnuncio.appendChild(imgElement);
      } else {
        console.error(
          'Error en la respuesta del servidor:',
          response.status,
          response.statusText,
        );
      }
    } catch (error) {
      console.error('Error al cargar la imagen:', error);
    }

    // Crear el contenido del anuncio
    const divInfo = document.createElement('div');
    divInfo.classList.add('anuncio-card-info');
    divInfo.innerHTML = `
      <h2>${anuncio.titulo}</h2>
      <p>${anuncio.descripcion}</p>
      <a href="/anunciante?id=${anuncio.anunciante}"><span>Publicado por ${anuncio.nombre_anunciante}</span></a>
    `;

    //Crear la estructura del anuncio y contenedores
    enlaceAnuncio.appendChild(divInfo);
    divAnuncio.appendChild(enlaceAnuncio);
    anunciosContenedor.appendChild(divAnuncio);
  }

  /**
 * Función para obtener una respuesta de la url
 * 
 */
function obtenerParametrosDesdeURL() {
  const urlParams = new URLSearchParams(window.location.search);
  if(urlParams.get('search')){
    return 1;
  }else if (urlParams.get('id')) {
    return 1;
  }else{
    return 0
  }
}

}
