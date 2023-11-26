const modo = document.querySelector('.modo');
const menuToggle = document.querySelector('.menu-toggle');
const menuFilter = document.querySelector('.menu-filter');
const navMenu = document.querySelector('.navMenu');
const navFilter = document.querySelector('.navFilter');

menuToggle.addEventListener('click', function () {
  navMenu.classList.toggle('show');
  if (navFilter.classList.contains('show')) {
    navFilter.classList.remove('show');
  }
});

menuFilter.addEventListener('click', function () {
  navFilter.classList.toggle('show');
  if (navMenu.classList.contains('show')) {
    navMenu.classList.remove('show');
  }
});

modo.addEventListener('click', function () {
  document.querySelector('body').classList.toggle('dark');
  if (cookieAceptado()) {
    console.log('KJHSAKJDH');
    let modo;
    let fechaExpiracion = new Date();
    // Añade 3 meses en milisegundos (3 meses * 30 días * 24 horas * 60 minutos * 60 segundos * 1000 milisegundos)
    fechaExpiracion.setTime(
      fechaExpiracion.getTime() + 3 * 30 * 24 * 60 * 60 * 1000,
    );
    fechaExpiracion = fechaExpiracion.toUTCString();
    document.body.classList.contains('dark')
      ? (modo = 'dark')
      : (modo = 'light');
    document.cookie =
      'modo=' + modo + '; expires=' + fechaExpiracion + '; path=/';
  }
});

function cookieAceptado() {
  let aceptado = localStorage.getItem('cookieAceptado');
  return aceptado == true;
}

// Para buscar
const searchFormInput = document.querySelector('#form-search input');
let searchTimeout;

searchFormInput.addEventListener('input', () => {
  clearTimeout(searchTimeout);
  searchTimeout = setTimeout(search, 1000);
});

async function search() {
  try {
    const response = await fetch(
      `/?search=${searchFormInput.value.toLowerCase().trim()}&desde_cliente`,
    );
    if (response.ok) {
      const data = await response.json();
      console.log('Respuesta:', data);
      mostrarAnunciosBuscados(data);
      console.log('BUENAS');
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

async function mostrarAnunciosBuscados(anuncios) {
  console.log('EN MOSTRAR');
  const anunciosContenedor = document.querySelector('.anuncios');
  console.log(anunciosContenedor);

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

    // Imagen
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

    // Contenido del anuncio
    const divInfo = document.createElement('div');
    divInfo.classList.add('anuncio-card-info');
    divInfo.innerHTML = `
      <h2>${anuncio.titulo}</h2>
      <p>${anuncio.descripcion}</p>
      <a href="/anunciante?id=${anuncio.anunciante}"><span>Publicado por ${anuncio.nombre_anunciante}</span></a>
    `;

    enlaceAnuncio.appendChild(divInfo);
    divAnuncio.appendChild(enlaceAnuncio);
    anunciosContenedor.appendChild(divAnuncio);
  }
}
