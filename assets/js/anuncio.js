let carrusel = document.querySelector('.carrusel');
let imagenActual = 0;
let totalDeImagenes = 3;

let favorito = document.querySelector('#favorito');

document
  .getElementById('anterior')
  .addEventListener('click', () => cambiarImagen(-1));
document
  .getElementById('siguiente')
  .addEventListener('click', () => cambiarImagen(1));

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

function mostrarImagen(indice) {
  carrusel.style.transform = `translateX(-${indice * 100}%)`;
}

function actualizarBotones() {
  document.getElementById('anterior').disabled = imagenActual === 0;
  document.getElementById('siguiente').disabled =
    imagenActual === totalDeImagenes - 1;
}

favorito.addEventListener('click', gestionarFavorito);

async function gestionarFavorito() {
  console.log(favorito.checked);
  if (favorito.checked === false) borrarFavorito();
  else registrarFavorito();
}

async function registrarFavorito() {
  let queryString = window.location.search;

  let params = new URLSearchParams(queryString);

  const anuncio = params.get('id');

  const formData = new FormData();

  formData.append('anuncio', anuncio);

  formData.append('favorito', favorito.checked);

  // Validaciones
  try {
    const response = await fetch('/anuncio', {
      method: 'POST',
      body: formData,
    });
    if (response.ok) {
      const data = await response.text();
      console.log(data);
    }
  } catch (error) {
    console.log(error);
  }
}
function obtenerIdDesdeURL() {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get('id');
}
async function borrarFavorito() {
  try {
    const response = await fetch(
      `/anuncio?id=${obtenerIdDesdeURL()}&borrar_fav`,
      {
        method: 'GET',
      },
    );
  } catch (error) {}
}
