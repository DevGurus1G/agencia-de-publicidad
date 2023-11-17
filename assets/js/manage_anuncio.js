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

async function registrarAnuncio() {
  const titulo = document.getElementById('tituloAnuncio').value;
  const categoria = document.getElementById('categoriaAnuncio').value;
  const descripcion = document.getElementById('descripcionAnuncio').value;
  const precio = document.getElementById('precioAnuncio').value;
  
  const imagen1 = document.getElementById('imagen1').files[0];
  const imagen2 = document.getElementById('imagen2').files[0];
  const imagen3 = document.getElementById('imagen3').files[0];

  const formData = new FormData();
  formData.append('titulo', titulo);
  formData.append('categoria', categoria);
  formData.append('descripcion', descripcion);
  formData.append('precio', precio);
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
