const btnCargarMas = document.getElementById('cargar-mas');
const loader = document.getElementById('loader');
let anuncio;

btnCargarMas.addEventListener('click', async () => {
  anuncio = document.querySelector('.anuncios .anuncio-card:last-of-type');

  if (anuncio) {
    let fechaCreado = anuncio.getAttribute('data-fecha-creado');
    console.log('FECHA: ' + fechaCreado);
    await cargarMasAnuncios(fechaCreado);
  }
});

async function cargarMasAnuncios(fechaCreado) {
  showLoader();
  try {
    const response = await fetch(`/?cargar-mas=${fechaCreado}`);
    console.log('DESPUS');
    if (response.ok) {
      const data = await response.json();
      console.log(data);
      mostrarAnunciosCargados(data);
      anuncio = document.querySelector('.anuncios .anuncios-card:last-of-type');
    }
  } catch (error) {
    // resultado.textContent = 'Error en la solicitud intentelo mas tarde';
  } finally {
    hideLoader();
  }
}

async function mostrarAnunciosCargados(anuncios) {
  let cadena = '';

  for (const anuncio of anuncios) {
    cadena += `<div class='anuncio-card' data-fecha-creado='${anuncio.creado}' data-id='${anuncio.primera_imagen_id}'>`;
    cadena += `<a href="/anuncio?id=${anuncio.anuncio_id}" class="enlace-anuncio-card">`;

    // Imagen
    try {
      const response = await fetch(`/?img=${anuncio.primera_imagen_id}`);

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
  loader.style.display = 'inline-block';
  btnCargarMas.disabled = true;
}

function hideLoader() {
  loader.style.display = 'none';
  btnCargarMas.disabled = false;
}

// Para el guardado de si nos aceptan las cookies

let aceptado = localStorage.getItem('cookieAceptado');
let cDialogo = document.querySelector('.container-dialogo');

if (aceptado === null) {
  cDialogo.classList.toggle('active');
}

// Listeners
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
