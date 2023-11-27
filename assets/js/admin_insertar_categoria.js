/**
 * Elemento del formulario de registro.
 * @type {HTMLFormElement}
 */
const registroForm = document.getElementById('formAdmin');

/**
 * Botón para enviar el formulario.
 * @type {HTMLButtonElement}
 */
const insertarBoton = document.getElementById("enviar");

//Listener para evitar el envio default y la funcionalidad en el click en el boton de insertar
registroForm.addEventListener('submit', (e) => e.preventDefault());
insertarBoton.addEventListener('click', crearCategoria);

/**
 * Función para mostrar la imagen seleccionada en el avatar.
 */
document.getElementById('imagen').addEventListener('change', () => {
  const file = document.getElementById('imagen').files[0];
  const reader = new FileReader();

  reader.addEventListener('load', () => {
    document.querySelector('#avatar').data = reader.result;
  });
  reader.readAsDataURL(file);
});

/**
 * Función asincrona para enviar datos al servidor y crear una categoría.
 * @async
 * @returns {Promise<void>} Una promesa sin valor de retorno.
 */
async function crearCategoria() {
  //Variables con los datos del formulario
  const nombre = document.getElementById('nombre').value;
  let imagen = document.getElementById('imagen').files[0];

  //Si no se sube una imagen le agrega una por defecto en formato blob para evitar errores
  const imagenPorDefecto = await fetch('/assets/img/noPhotoSvg.svg');
  const imagenPorDefectoBlob = await imagenPorDefecto.blob();

  if(imagen === undefined){
    imagen = new File([imagenPorDefectoBlob], 'default.png', { type: 'image/svg+xml' });
  }
 
  //Envio de datos al servidor en FormData
  const formData = new FormData();
  formData.append('nombre', nombre);
  formData.append('imagen', imagen);
  formData.append('categoria', "categoria"); 

  try {
    const response = await fetch('/admin/insertar', {
      method: 'POST',
      body: formData,
    });
    if (response.ok) {
      const data = await response.text();
      if (data === 'CategoriaInsertada') {
        window.location.href = '/admin';
      }
    } else {
      alert('Error en la solicitud, inténtelo más tarde');
    }
  } catch (error) {
    alert('Error en la solicitud, inténtelo más tarde');
  }
}
