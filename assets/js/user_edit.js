const btnRegister = document.getElementById('registroUser-btn');
const formRegister = document.querySelector('form');

formRegister.addEventListener('submit', (e) => e.preventDefault);
btnRegister.addEventListener('click', edit);

document.querySelector('#imagen').addEventListener('change', () => {
    const file = document.querySelector('#imagen').files[0];
    const reader = new FileReader();
    reader.addEventListener('load', () => {
      document.querySelector('#avatar').src = reader.result;
    });
    reader.readAsDataURL(file);
  });
    
    const mostrarContraseñaCheckbox = document.getElementById('cambiarPassword');
    const passwordFields = document.querySelectorAll('.passwordField');

    mostrarContraseñaCheckbox.addEventListener('change', function () {
      passwordFields.forEach(function (field) {
        field.hidden = !mostrarContraseñaCheckbox.checked;
      });
    });

function b64toBlob(base64, contentType) {
    contentType = contentType || '';
    var sliceSize = 1024;
    var byteCharacters = atob(base64);
    var byteArrays = [];

    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize);
        var byteNumbers = new Array(slice.length);

        for (var i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        var byteArray = new Uint8Array(byteNumbers);
        byteArrays.push(byteArray);
    }

    return new Blob(byteArrays, { type: contentType });
}


async function edit() {

    const nombre = document.getElementById('nombreUser').value;
    const apellidos = document.getElementById('apellidosUser').value;
    const email = document.getElementById('emailUser').value;
    const username = document.getElementById('usernameUser').value;
    const passwordActual = document.getElementById('passwordUserActual').value
    const password = document.getElementById('passwordUser').value;
    const password2 = document.getElementById('passwordUser2').value;
    let imagen = document.getElementById('imagen').files[0];
    const cambiarPassword = document.getElementById('cambiarPassword').checked;
    
    //Si no se sube una imagen le agrega una por defecto en formato blob para evitar errores
    let imagenElemento = document.getElementById('avatar');
            
    // Obtiene el contenido de la imagen en base64
    let imagenBase64 = imagenElemento.src.split(',')[1];

    // Convierte la imagen en base64 a un blob
    let blob = b64toBlob(imagenBase64, 'image/jpeg');

    // Crea un objeto File a partir del blob
    let imagenFile = new File([blob], 'nombre_de_archivo.jpg', { type: 'image/jpeg' });

    if(imagen === undefined){
        imagen = imagenFile
      }

    if (cambiarPassword) {
        if (password == password2 && password !== "") {
            const formData = new FormData();
            formData.append('cambioPassword', "siCambiar");
            formData.append('nombre', nombre);
            formData.append('apellidos', apellidos);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('username', username);
            formData.append('imagen', imagen);
            formData.append('passwordActual',passwordActual);
        
            try {
            const response = await fetch('/user/edit', {
                method: 'POST',
                body: formData,
            });
            if (response.ok) {
                const data = await response.text();
                console.log(data);
                if (data === 'editado') {
                window.location.href = '/user';
                }
            } else {
                console.error(response);
            }
            } catch (error) {
            alert('Error en la solicitud intentelo mas tarde');
            }
        }else{
            alert("Los campos de contaseña nueva debe coincidir o no estar en blanco.");
        }
    }else{
        const formData = new FormData();
        formData.append('cambioPassword', "noCambiar");
        formData.append('nombre', nombre);
        formData.append('apellidos', apellidos);
        formData.append('email', email);
        formData.append('username', username);
        formData.append('imagen', imagen);
        formData.append('passwordActual',passwordActual);
    
        try {
        const response = await fetch('/user/edit', {
            method: 'POST',
            body: formData,
        });
        if (response.ok) {
            const data = await response.text();
            console.log(data);
            if (data === 'editado') {
            window.location.href = '/user';
            }
        } else {
            console.error(response);
        }
        } catch (error) {
            alert('Error en la solicitud intentelo mas tarde');
        }
    }
            
  }