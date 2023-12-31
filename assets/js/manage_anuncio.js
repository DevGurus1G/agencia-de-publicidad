/**
 * Elementos del HTML seleccionados.
 * @type {HTMLElement}
 */
const registroForm = document.getElementById('registroAnuncio-form');
const registroBtn = document.getElementById('registroAnuncio-btn');
const editarInput = document.getElementById('editar_anuncio').value;

/**
 * Listener para prevenir el envío del formulario mediante el submit del form.
 * @listens submit
 * @param {Event} e - Evento de submit del formulario.
 */
registroForm.addEventListener('submit', (e) => e.preventDefault());

/**
 * Listener para saber si se está editando un anuncio o creando uno nuevo.
 * @listens click
 */
registroBtn.addEventListener('click', async () => {
  if (editarInput == -1) await registrarAnuncio();
  else await actualizarAnuncio(editarInput);
});

//Funcion para mostrar en los avatares las imagenes que se van a enviar
document.getElementById('imagen1').addEventListener('change', () => {
  const file = document.getElementById('imagen1').files[0];
  const reader = new FileReader();
  reader.addEventListener('load', () => {
    document.querySelector('#avatar1').src = reader.result;
  });
  reader.readAsDataURL(file);
});

document.getElementById('imagen2').addEventListener('change', () => {
  const file = document.getElementById('imagen2').files[0];
  const reader = new FileReader();
  reader.addEventListener('load', () => {
    document.querySelector('#avatar2').src = reader.result;
  });
  reader.readAsDataURL(file);
});

document.getElementById('imagen3').addEventListener('change', () => {
  const file = document.getElementById('imagen3').files[0];
  const reader = new FileReader();
  reader.addEventListener('load', () => {
    document.querySelector('#avatar3').src = reader.result;
  });
  reader.readAsDataURL(file);
});

//Validaciones
//No dejar incluir puntos o digitos en el precio
document.getElementById('precioAnuncio').addEventListener('keypress', function (event) {
    const char = event.key;
    if (isNaN(parseInt(char)) && char !== ',') {
      event.preventDefault();
    }
  });

/**
 * Validación del título, descripción y precio del anuncio.
 * @param {string} titulo - Título del anuncio.
 * @param {string} descripcion - Descripción del anuncio.
 * @param {string} precioConPunto - Precio del anuncio con punto decimal.
 * @returns {boolean} Devuelve true si la validación es exitosa, de lo contrario, false.
 */
function validarAnuncio(titulo, descripcion, precioConPunto) {
  if (titulo.trim() === '' ||descripcion.trim() === '' ||precioConPunto.trim() === '') {
    alert('Por favor, complete todos los campos.');
    return false;
  }

  if (titulo.length > 255 || descripcion.length > 255) {
    alert('El título y la descripción deben tener máximo 255 caracteres.');
    return false;
  }

  const precioRegex = /^\d{1,8}(\.\d{1,2})?$/; // Acepta de 1 a 8 dígitos antes del punto y opcionalmente 1 o 2 dígitos después del punto

  if (!precioRegex.test(precioConPunto)) {
    alert('Ingrese un precio válido (máximo 10 caracteres y hasta dos decimales).');
    return false;
  }

  if (isNaN(parseFloat(precioConPunto)) || parseFloat(precioConPunto) <= 0) {
    alert('Ingrese un precio válido.');
    return false;
  }
  return true;
}

/**
 * Función asincrónica para enviar al servidor los datos para registrar un anuncio.
 * @async
 */
async function registrarAnuncio() {
  //Constantes con los datos del formulario
  const titulo = document.getElementById('tituloAnuncio').value;
  const categoria = document.getElementById('categoriaAnuncio').value;
  const descripcion = document.getElementById('descripcionAnuncio').value;
  const precio = document.getElementById('precioAnuncio').value;
  const precioConPunto = precio.replace(',', '.');

  if (!validarAnuncio(titulo, descripcion, precioConPunto)) {
    return; // Si la validación falla, detener el registro del anuncio
  }
  let imagen1 = document.getElementById('imagen1').files[0];
  let imagen2 = document.getElementById('imagen2').files[0];
  let imagen3 = document.getElementById('imagen3').files[0];
  //Si no se sube una imagen le agrega una por defecto en formato blob para evitar errores
  const imagenPorDefecto = await fetch('/assets/img/noPhoto.png');
  const imagenPorDefectoBlob = await imagenPorDefecto.blob();

  if (imagen1 === undefined) {
    imagen1 = new File([imagenPorDefectoBlob], 'default.png', {
      type: 'image/png',
    });
  }
  if (imagen2 === undefined) {
    imagen2 = new File([imagenPorDefectoBlob], 'default.png', {
      type: 'image/png',
    });
  }
  if (imagen3 === undefined) {
    imagen3 = new File([imagenPorDefectoBlob], 'default.png', {
      type: 'image/png',
    });
  }

  const formData = new FormData();
  formData.append('titulo', titulo);
  formData.append('categoria', categoria);
  formData.append('descripcion', descripcion);
  formData.append('precio', precioConPunto);
  //Estas imagenes tienen que ir a la tabla imagen_anuncio
  formData.append('imagen1', imagen1);
  formData.append('imagen2', imagen2);
  formData.append('imagen3', imagen3);
  formData.append('editar_anuncio', editarInput);
  try {
    const response = await fetch('/anuncio/manage', {
      method: 'POST',
      body: formData,
    });
    if (response.ok) {
      const data = await response.text();
      if (data === 'registrado') {
        window.location.href = '/';
      }
    } else {
      console.error('Error en la solicitud. Inténtelo más tarde.');
    }
  } catch (error) {
    console.error('Error en la solicitud. Inténtelo más tarde.');
  }
}

/**
 * Función asincrónica para enviar al servidor los datos para actualizar un anuncio.
 * @async
 * @param {string} idAnuncio - ID del anuncio a actualizar.
 */
async function actualizarAnuncio(idAnuncio) {
  //Constantes con los datos del formulario
  const titulo = document.getElementById('tituloAnuncio').value;
  const categoria = document.getElementById('categoriaAnuncio').value;
  const descripcion = document.getElementById('descripcionAnuncio').value;
  const precio = document.getElementById('precioAnuncio').value;
  const precioConPunto = precio.replace(',', '.');

  if (!validarAnuncio(titulo, descripcion, precioConPunto)) {
    return; // Si la validación falla, detener la actualización del anuncio
  }

  const formData = new FormData();
  formData.append('id', idAnuncio);
  formData.append('titulo', titulo);
  formData.append('categoria', categoria);
  formData.append('descripcion', descripcion);
  formData.append('precio', precioConPunto);
  formData.append('editar_anuncio', idAnuncio);

  // Obtener las imágenes existentes y agregarlas al FormData
  for (let i = 1; i <= 3; i++) {
    const imagenInput = document.getElementById(`imagen${i}`);
    const imagen = imagenInput.files[0];

    if (imagen) {
      formData.append(`imagen${i}`, imagen);
    } else {
      // Si no se selecciona una nueva imagen, usar la existente
      const imagenExistente = document.getElementById(`avatar${i}`);
      const base64Imagen = imagenExistente.src.split(',')[1];
      const blob = await fetch(`data:image/png;base64,${base64Imagen}`).then(
        (res) => res.blob(),
      );
      formData.append(`imagen${i}`, new File([blob], `imagen${i}.png`));
      console.log(blob);
    }
  }

  try {
    const response = await fetch(`/anuncio/manage?editar=${idAnuncio}`, {
      method: 'POST',
      body: formData,
    });

    if (response.ok) {
      const data = await response.text();
      if (data === 'actualizado') {
        window.location.href = '/';
      } else {
        console.log(data);
      }
    } else {
      console.error('Error en la solicitud. Inténtelo más tarde.');
    }
  } catch (error) {
    console.error('Error en la solicitud. Inténtelo más tarde.');
  }
}
