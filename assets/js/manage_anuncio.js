const registroForm = document.getElementById('registroAnuncio-form');

registroForm.addEventListener('submit', (e) => e.preventDefault());

const registroBtn = document.getElementById('registroAnuncio-btn');

registroBtn.addEventListener('click', registrarAnuncio);

//Funciones para mostrar imagen a subir
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

function validarAnuncio(titulo,descripcion,precioConPunto) {
  if (titulo.trim() === '' || descripcion.trim() === '' || precioConPunto.trim() === '') {
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

async function registrarAnuncio() {
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
 
  if(imagen1 === undefined){
    imagen1 = new File([imagenPorDefectoBlob], 'default.png', { type: 'image/png' });
  }
  if(imagen2 === undefined){
    imagen2 = new File([imagenPorDefectoBlob], 'default.png', { type: 'image/png' });
  }
  if(imagen3 === undefined){
    imagen3 = new File([imagenPorDefectoBlob], 'default.png', { type: 'image/png' });
  }


  const formData = new FormData();
  formData.append('titulo', titulo);
  formData.append('categoria', categoria);
  formData.append('descripcion', descripcion);
  formData.append('precio', precioConPunto);
  //   Esto tiene que ir a la tabla imagen_anuncio
   formData.append('imagen1', imagen1);
   formData.append('imagen2', imagen2);
   formData.append('imagen3', imagen3);
  // Validaciones
  try {
    const response = await fetch('/anuncio/manage', {
      method: 'POST',
      body: formData,
    });
    if (response.ok) {
      const data = await response.text();
      if (data === 'registrado') {
        window.location.href = '/';
      } else {
        console.log(data);
      }
    } else {
      resultado.textContent = 'Error en la solicitud intentelo mas tarde';
    }
  } catch (error) {
    resultado.textContent = 'Error en la solicitud intentelo mas tarde';
  }
}
