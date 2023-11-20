
let btnUsuarios = document.getElementById('usuarios');
let btnEmpresas = document.getElementById('empresas');
let btnAnuncios = document.getElementById('anuncios');
let btnCategorias = document.getElementById('categorias');

btnUsuarios.addEventListener('click', async () => {
    const formData = new FormData();
    formData.append('tabla', btnUsuarios.value);
    try {
        const response = await fetch('/admin', {
            method: 'POST',
            body: formData,
        });
        if (response.ok) {
            const data = await response.text();
            console.log(data + 'lñksadfñkjas');
            // Actualiza el contenido del div con id "tabla"
            document.getElementById('tabla').innerHTML = data;
        } else {
            console.error(response);
        }
    } catch (error) {
        alert('Error en la solicitud, inténtelo más tarde');
    }
});

btnEmpresas.addEventListener('click', async () => {
    const formData = new FormData();
    formData.append('tabla', btnEmpresas.value);
    try {
        const response = await fetch('/admin', {
            method: 'POST',
            body: formData,
        });
        if (response.ok) {
            const data = await response.text();
            console.log(data + 'lñksadfñkjas');
            // Actualiza el contenido del div con id "tabla"
            document.getElementById('tabla').innerHTML = data;
        } else {
            console.error(response);
        }
    } catch (error) {
        alert('Error en la solicitud, inténtelo más tarde');
    }
});


btnAnuncios.addEventListener('click', async () => {
    const formData = new FormData();
    formData.append('tabla', btnAnuncios.value);
    try {
        const response = await fetch('/admin', {
            method: 'POST',
            body: formData,
        });
        if (response.ok) {
            const data = await response.text();
            console.log(data + 'lñksadfñkjas');
            // Actualiza el contenido del div con id "tabla"
            document.getElementById('tabla').innerHTML = data;
        } else {
            console.error(response);
        }
    } catch (error) {
        alert('Error en la solicitud, inténtelo más tarde');
    }
});


btnCategorias.addEventListener('click', async () => {
    const formData = new FormData();
    formData.append('tabla', btnCategorias.value);
    try {
        const response = await fetch('/admin', {
            method: 'POST',
            body: formData,
        });
        if (response.ok) {
            const data = await response.text();
            console.log(data + 'lñksadfñkjas');
            // Actualiza el contenido del div con id "tabla"
            document.getElementById('tabla').innerHTML = data;
        } else {
            console.error(response);
        }
    } catch (error) {
        alert('Error en la solicitud, inténtelo más tarde');
    }
});