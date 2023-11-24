const btnCargarMas = document.getElementById('cargar-mas');
const loader = document.getElementById('loader');
let anuncio;
console.log(btnCargarMas);

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
      mostrarAnunciosBuscados(data);
      anuncio = document.querySelector('.anuncios .anuncios-card:last-of-type');
    }
  } catch (error) {
    // resultado.textContent = 'Error en la solicitud intentelo mas tarde';
  } finally {
    hideLoader();
  }
}

async function mostrarAnunciosBuscados(anuncios) {
  let cadena = '';

  for (const anuncio of anuncios) {
    cadena += `<div class='anuncio-card' data-fecha-creado='${anuncio.creado}' >`;

    // Imagen
    try {
      const response = await fetch(`/?img=${anuncio.primera_imagen_id}`);

      if (response.ok) {
        // const blob = await response.blob();
        // console.log(blob);
        // const imagenUrl = URL.createObjectURL(blob);
        // cadena += `<img src="${imagenUrl}" alt="Foto del anuncio mostrado" />`;
        const imgBase64 = await response.text();
        cadena += `<img src="data:image/png;base64,${imgBase64}" alt="Prueba"/>`;
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
    cadena += `</div>`;
    cadena += `</div>`;
  }

  //   document.querySelector('main').innerHTML += cadena;
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
