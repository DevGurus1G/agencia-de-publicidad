const btnPaso1 = document.getElementById('btn-paso1');
const btnPaso2Volver = document.getElementById('btn-paso2-volver');
const btnPaso2Seguir = document.getElementById('btn-paso2-seguir');
const btnPaso3 = document.getElementById('btn-paso3');
// Para registar

const formRegister = document.querySelector('form');

formRegister.addEventListener('submit', async (e) => {
  e.preventDefault(); // Detener el envío del formulario por defecto

  const nombre = document.getElementById('nombre').value;
  const apellidos = document.getElementById('apellidos').value;
  const email = document.getElementById('email').value;
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  const validacionExitosa = validarUsuario(nombre, apellidos, email, username, password);

  if (!validacionExitosa) {
    return; // Detener el envío del formulario si la validación falla
  }

  await registro(); // Continuar con el proceso de registro si la validación es exitosa
});

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

function validarUsuario(nombre, apellidos, email,username,password){
  if (!nombre.trim() || !apellidos.trim() || !email.trim() || !username.trim() || !password.trim()) {
    alert('Por favor, complete todos los campos.');
    return false;
  }

  if (nombre.length > 255 || apellidos.length > 255 || email.length > 255 || username.length > 255 || password.length > 255) {
    alert('La longitud máxima de los campos es de 255 caracteres.');
    return false;
  }

  // Validar dirección de correo electrónico
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    alert('Ingrese una dirección de correo electrónico válida.');
    return false;
  }
  return true;
}

async function registro() {
  const nombre = document.getElementById('nombre').value;
  const apellidos = document.getElementById('apellidos').value;
  const email = document.getElementById('email').value;
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  if (!validarUsuario(nombre, apellidos, email,username,password)) {
    return; // Si la validación falla, detener el registro del anuncio
  }
  //Si no se sube una imagen le agrega una por defecto en formato blob para evitar errores
  
  const imagenPorDefecto = await fetch('/assets/img/noPhoto.png');
  const imagenPorDefectoBlob = await imagenPorDefecto.blob();
 
  let imagen = document.getElementById('imagen').files[0];
  if(imagen === undefined){
    imagen = new File([imagenPorDefectoBlob], 'default.png', { type: 'image/png' });
  }
  
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
      if (data === 'registrado') {
        window.location.href = '/login';
      }
    } else {
      console.error(response);
    }
  } catch (error) {
    resultado.textContent = 'Error en la solicitud intentelo mas tarde';
  }
}
