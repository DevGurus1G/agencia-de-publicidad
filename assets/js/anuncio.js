let carrusel = document.querySelector('.carrusel');
let imagenActual = 0;
let totalDeImagenes = 2; // Ajusta el total de imágenes según sea necesario

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

favorito.addEventListener('click', registrarFavorito);

async function registrarFavorito()
{
  
  let queryString = window.location.search;

  let params = new URLSearchParams(queryString);

  const anuncio = params.get('id');

  const formData = new FormData();
  
  formData.append('anuncio', anuncio);

  formData.append('favorito', favorito.checked)

  // Validaciones
  try {
    const response = await fetch('/anuncio', {
      method: 'POST',
      body: formData,
    });
  } catch (error) {
    console.log(error);
  }
}
