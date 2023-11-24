const registroForm = document.getElementById('formAdmin');

registroForm.addEventListener('submit', (e) => e.preventDefault());

const insertarBoton = document.getElementById("enviar");

insertarBoton.addEventListener('click', crearCategoria);

document.getElementById('imagen').addEventListener('change', () => {
  const file = document.getElementById('imagen').files[0];
  const reader = new FileReader();

  reader.addEventListener('load', () => {
    document.querySelector('#avatar').data = reader.result;
  });

  // Lee el archivo como una URL de datos (data URL)
  reader.readAsDataURL(file);
});


async function crearCategoria() {
  const nombre = document.getElementById('nombre').value;
  let imagen = document.getElementById('imagen').files[0];

  //Si no se sube una imagen le agrega una por defecto en formato blob para evitar errores
  const imagenPorDefecto = await fetch('/assets/img/noPhotoSvg.svg');
  const imagenPorDefectoBlob = await imagenPorDefecto.blob();

  if(imagen === undefined){
    imagen = new File([imagenPorDefectoBlob], 'default.png', { type: 'image/svg+xml' });
  }
 


  const formData = new FormData();
  formData.append('nombre', nombre);
  formData.append('imagen', imagen);
  formData.append('categoria', "categoria"); 

  // Validaciones
  try {
    const response = await fetch('/admin/insertar', {
      method: 'POST',
      body: formData,
    });
    if (response.ok) {
      const data = await response.text();
      if (data === 'CategoriaInsertada') {
        window.location.href = '/admin';
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
