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
  if (favorito.checked == false) {
    borrarFavorito();
  } else if (favorito.checked) {
    registrarFavorito();
  }
}
function obtenerIdDesdeURL() {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get('id');
}
async function registrarFavorito() {
  console.log('EN registro');
  const formData = new FormData();

  formData.append('anuncio', obtenerIdDesdeURL());

  formData.append('favorito', 'insertar');

  // Validaciones
  try {
    const response = await fetch('/anuncio', {
      method: 'POST',
      body: formData,
    });
    if (response.ok) {
      const data = await response.text();
      console.log('data');
    }
  } catch (error) {
    console.log(error);
  }
}

async function borrarFavorito() {
  const anuncioId = obtenerIdDesdeURL();

  const formData = new FormData();
  formData.append('anuncio', anuncioId);
  formData.append('favorito', 'borrar');

  try {
    const response = await fetch('/anuncio', {
      method: 'POST',
      body: formData,
    });

    if (response.ok) {
      const data = await response.text();
      console.log(data);
    } else {
      console.error('Error al borrar favorito:', response.statusText);
    }
  } catch (error) {
    console.error('Error en la solicitud para borrar favorito:', error);
  }
}
