/**
 * Botón para mostrar la información de los usuarios compradores.
 * @type {HTMLElement}
 */
let btnUsuarios = document.getElementById('usuarios');

/**
 * Botón para mostrar la información de las empresas.
 * @type {HTMLElement}
 */
let btnEmpresas = document.getElementById('empresas');

/**
 * Botón para mostrar la información de los anuncios.
 * @type {HTMLElement}
 */
let btnAnuncios = document.getElementById('anuncios');

/**
 * Botón para mostrar la información de las categorías.
 * @type {HTMLElement}
 */
let btnCategorias = document.getElementById('categorias');

/**
 * Listener para mostrar la información de los usuarios compradores.
 * @listens click
 * @async
 */
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
            // Actualiza el contenido del div con los datos de los usuarios 
            document.getElementById('tabla').innerHTML = data;
        } else {
            console.error(response);
        }
    } catch (error) {
        alert('Error en la solicitud, inténtelo más tarde');
    }
});

/**
 * Listener para mostrar la informacion de las tiendas
 * @listens click
 * @async
 */
btnEmpresas.addEventListener('click', async () => {
    const formData = new FormData();
    formData.append('tabla', btnEmpresas.value);
    try {
        const response = await fetch('/admin', {
            method: 'POST',
            body: formData,
        });
        if (response.ok) {
            const data = await response.text()
            // Actualiza el contenido del div con los datos de las tiendas
            document.getElementById('tabla').innerHTML = data;
        } else {
            console.error(response);
        }
    } catch (error) {
        alert('Error en la solicitud, inténtelo más tarde');
    }
});

/**
 * Listener para mostrar la informacion de los anuncios
 * @listens click
 * @async
 */
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
            // Actualiza el contenido del div con los datos de los anuncios
            document.getElementById('tabla').innerHTML = data;
        } else {
            console.error(response);
        }
    } catch (error) {
        alert('Error en la solicitud, inténtelo más tarde');
    }
});

/**
 * Listener para mostrar la informacion de las categorias
 * @listens click
 * @async
 */
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
            // Actualiza el contenido del div con los datos de las categorias
            document.getElementById('tabla').innerHTML = data;
        } else {
            console.error(response);
        }
    } catch (error) {
        alert('Error en la solicitud, inténtelo más tarde');
    }
});