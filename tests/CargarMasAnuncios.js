const btnCargarMas = document.getElementById('cargar-mas');
const loader = document.getElementById('loader');
function getLoader() {
  return loader;
}

async function mostrarAnunciosCargados(anuncios, fetchFunction = fetch) {
  let cadena = '';

  for (const anuncio of anuncios) {
    cadena += `<div class='anuncio-card' data-fecha-creado='${anuncio.creado}' data-id='${anuncio.primera_imagen_id}'>`;
    cadena += `<a href="/anuncio?id=${anuncio.anuncio_id}" class="enlace-anuncio-card">`;

    // Imagen
    try {
      const response = await fetchFunction(
        `/?img=${anuncio.primera_imagen_id}`,
      );

      if (response.ok) {
        const imgBase64 = await response.text();
        cadena += `<img src="data:image/jpeg;base64,${imgBase64}" alt="Foto del anuncio mostrado" />`;
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

    // Contenido del anuncio
    cadena += `<div class="anuncio-card-info">`;
    cadena += `<h2>${anuncio.titulo}</h2>`;
    cadena += `<p>${anuncio.descripcion}</p>`;
    cadena += `<a href="/anunciante?id=${anuncio.anunciante}"><span>Publicado por ${anuncio.nombre_anunciante}</span></a>`;
    cadena += `</div>`;

    cadena += `</a>`;
    cadena += `</div>`;
  }

  document
    .querySelector('.anuncios')
    .appendChild(document.createRange().createContextualFragment(cadena));
}

function showLoader() {
  loader.classList.add('visible');
  btnCargarMas.disabled = true;
}

function hideLoader() {
  loader.classList.remove('visible');
  btnCargarMas.disabled = false;
}

// Exportar las funciones que necesitas utilizar en otras partes de tu aplicación o en las pruebas
module.exports = {
  mostrarAnunciosCargados,
  showLoader,
  hideLoader,
  getLoader,
  btnCargarMas,
};
