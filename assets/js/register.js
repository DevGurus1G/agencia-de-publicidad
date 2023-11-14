const btnPaso1 = document.getElementById('btn-paso1');
const btnPaso2Volver = document.getElementById('btn-paso2-volver');
const btnPaso2Seguir = document.getElementById('btn-paso2-seguir');
const btnPaso3 = document.getElementById('btn-paso3');
console.log(btnPaso1);
// Para registar

const formRegister = document.querySelector('form');
const btnRegister = document.querySelector('#registro-btn');

formRegister.addEventListener('submit', (e) => e.preventDefault);
btnRegister.addEventListener('click', registro);

btnPaso1.addEventListener('click', () => mostrarPaso(2));
btnPaso2Volver.addEventListener('click', () => mostrarPaso(1));
btnPaso2Seguir.addEventListener('click', () => mostrarPaso(3));
btnPaso3.addEventListener('click', () => mostrarPaso(2));

document.querySelector('#imagen').addEventListener('change', () => {
  const file = document.querySelector('#imagen').files[0];
  const reader = new FileReader();
  reader.addEventListener('load', () => {
    document.querySelector('#avatar').src = reader.result;
  });
  reader.readAsDataURL(file);
});

function mostrarPaso(paso) {
  document.querySelectorAll('.formulario-paso').forEach((seccion) => {
    seccion.classList.remove('formulario-paso-activo');
  });

  document
    .getElementById('paso' + paso)
    .classList.add('formulario-paso-activo');

  document.querySelectorAll('.indicador').forEach((indicador, index) => {
    if (index + 1 === paso) {
      indicador.classList.add('indicador-activo');
    } else {
      indicador.classList.remove('indicador-activo');
    }
  });
}

async function registro() {
  const nombre = document.getElementById('nombre').value;
  const apellidos = document.getElementById('apellidos').value;
  const email = document.getElementById('email').value;
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  const imagen = document.getElementById('imagen').files[0];
  const tipoUsuario = document.querySelector(
    "input[type='radio']:checked",
  ).value;
  const resultado = document.querySelector('.resultado');

  const formData = new FormData();
  formData.append('nombre', nombre);
  formData.append('apellidos', apellidos);
  formData.append('email', email);
  formData.append('username', username);
  formData.append('password', password);
  formData.append('imagen', imagen);
  formData.append('tipo', tipoUsuario);

  try {
    const response = await fetch('/register', {
      method: 'POST',
      body: formData,
    });
    if (response.ok) {
      const data = await response.text();
      console.log(data);
      if (data === 'registrado') window.location.href = '/';
    } else {
      console.error(response);
    }
  } catch (error) {
    resultado.textContent = 'Error en la solicitud intentelo mas tarde';
  }
}
