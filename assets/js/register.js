/**
 * Elementos del formulario y botones de navegación entre pasos.
 * @type {HTMLElement}
 */
const btnPaso1 = document.getElementById('btn-paso1');
const btnPaso2Volver = document.getElementById('btn-paso2-volver');
const btnPaso2Seguir = document.getElementById('btn-paso2-seguir');
const btnPaso3 = document.getElementById('btn-paso3');
const formRegister = document.querySelector('form');

/**
 * Listener para el evento 'submit' del formulario.
 * @listens submit
 */
formRegister.addEventListener('submit', async (e) => {
  /**
   * Evento para evitar el envío del formulario por defecto.
   * @param {Event} e - Evento del formulario.
   */
  e.preventDefault();

  //Valores recogidos del formulario
  const nombre = document.getElementById('nombre').value;
  const apellidos = document.getElementById('apellidos').value;
  const email = document.getElementById('email').value;
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  const validacionExitosa = validarUsuario(nombre, apellidos, email, username, password);

  // Detener el envío del formulario si la validación falla
  if (!validacionExitosa) {
    return; 
  }

  // Continuar con el proceso de registro si la validación es exitosa
  await registro();
});

/**
 * Listeners para navegar entre pasos del formulario.
 * @listens click
 */
btnPaso1.addEventListener('click', () => mostrarPaso(2));
btnPaso2Volver.addEventListener('click', () => mostrarPaso(1));
btnPaso2Seguir.addEventListener('click', () => mostrarPaso(3));
btnPaso3.addEventListener('click', () => mostrarPaso(2));

//Funcion para mostrar en el avatar la imagen que se va a enviar
document.querySelector('#imagen').addEventListener('change', () => {
  const file = document.querySelector('#imagen').files[0];
  const reader = new FileReader();
  reader.addEventListener('load', () => {
    document.querySelector('#avatar').src = reader.result;
  });
  reader.readAsDataURL(file);
});

//Funciones para avanzar o retroceder en las ventanas del formulario
function mostrarPaso(paso) {
  document.querySelectorAll('.formulario-paso').forEach((seccion) => {
    seccion.classList.remove('formulario-paso-activo');
  });

  document.getElementById('paso' + paso).classList.add('formulario-paso-activo');

  document.querySelectorAll('.indicador').forEach((indicador, index) => {
    if (index + 1 === paso) {
      indicador.classList.add('indicador-activo');
    } else {
      indicador.classList.remove('indicador-activo');
    }
  });
}

/**
 * Función para validar los campos del formulario de registro de usuario.
 * @param {string} nombre - El nombre real del usuario.
 * @param {string} apellidos - Los apellidos del usuario.
 * @param {string} email - El correo electrónico del usuario.
 * @param {string} username - El username del usuario.
 * @param {string} password - La contraseña del usuario.
 * @returns {boolean} Devuelve true si la validación es exitosa, false en caso contrario.
 */
function validarUsuario(nombre, apellidos, email,username,password){
  if (!nombre.trim() || !apellidos.trim() || !email.trim() || !username.trim() || !password.trim()) {
    alert('Por favor, complete todos los campos.');
    return false;
  }

  if (nombre.length > 255 || apellidos.length > 255 || email.length > 255 || username.length > 255 || password.length > 255) {
    alert('La longitud máxima de los campos es de 255 caracteres.');
    return false;
  }

  // Validar dirección de correo electrónico con regex
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    alert('Ingrese una dirección de correo electrónico válida.');
    return false;
  }
  return true;
}

/**
 * Funcion asincrona para el envio del formulario al servidor
 *
 * @async
 * @returns {Promise<void>}
 */
async function registro() {
  //Constantes con todos los valores del formulario
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

  //Creacion del objeto FormData y envio al servidor
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
