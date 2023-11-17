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


async function edit() {

    const nombre = document.getElementById('nombreUser').value;
    const apellidos = document.getElementById('apellidosUser').value;
    const email = document.getElementById('emailUser').value;
    const username = document.getElementById('usernameUser').value;
    const passwordActual = document.getElementById('passwordUserActual').value
    const password = document.getElementById('passwordUser').value;
    const password2 = document.getElementById('passwordUser2').value;
    const imagen = document.getElementById('imagen').files[0];
    const cambiarPassword = document.getElementById('cambiarPassword').checked;
    console.log(password);

    console.log(passwordActual);

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
                console.log(data + 'lñksadfñkjas');
                if (data === 'registrado') {
                window.location.href = '/';
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
        console.log("Hola")
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
            console.log(data + 'lñksadfñkjas');
            if (data === 'registrado') {
            window.location.href = '/';
            }
        } else {
            console.error(response);
        }
        } catch (error) {
            alert('Error en la solicitud intentelo mas tarde');
        }
    }
            
  }