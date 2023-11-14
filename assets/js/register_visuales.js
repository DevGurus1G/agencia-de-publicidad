const btnPaso1 = document.getElementById('btn-paso1');
const btnPaso2Volver = document.getElementById('btn-paso2-volver');
const btnPaso2Seguir = document.getElementById('btn-paso2-seguir');
const btnPaso3 = document.getElementById('btn-paso3');

btnPaso1.addEventListener('click', () => mostrarPaso(2));
btnPaso2Volver.addEventListener('click', () => mostrarPaso(1));
btnPaso2Seguir.addEventListener('click', () => mostrarPaso(3));
btnPaso3.addEventListener('click', () => mostrarPaso(2));
// Para la preview de la imagen

document.querySelector('#imagen').addEventListener('change', () => {
  const file = document.querySelector('#imagen').files[0];
  const reader = new FileReader();
  reader.addEventListener('load', () => {
    document.querySelector('#avatar').src = reader.result;
  });
  reader.readAsDataURL(file);
});

function mostrarPaso(paso) {
  // Desactiva la clase "formulario-paso-activo" en todas las secciones
  document.querySelectorAll('.formulario-paso').forEach((seccion) => {
    seccion.classList.remove('formulario-paso-activo');
  });

  // Activa la clase "formulario-paso-activo" en la sección seleccionada
  document
    .getElementById('paso' + paso)
    .classList.add('formulario-paso-activo');

  // Actualiza los indicadores de paso
  document.querySelectorAll('.indicador').forEach((indicador, index) => {
    if (index + 1 === paso) {
      indicador.classList.add('indicador-activo');
    } else {
      indicador.classList.remove('indicador-activo');
    }
  });
}

// Para cambiar al login

const btnIrLogin = document.getElementById('btn-ir-login');

btnIrLogin.addEventListener('click', () => {
  document.querySelector('.register').style.display = 'none';
  document.querySelector('.login').classList.add('active');
});
