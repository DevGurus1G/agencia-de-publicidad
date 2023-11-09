let carrusel = document.querySelector('.carrusel');
let imagenActual = 0;
let totalDeImagenes = 2; // Ajusta el total de imágenes según sea necesario

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
