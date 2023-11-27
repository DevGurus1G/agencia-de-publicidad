/**
 * Constante que selecciona el formulario HTML.
 * @constant {HTMLElement}
 */
const loginForm = document.querySelector('form');

/**
 * Listener para evitar el envío del formulario y usar la función login.
 * @listens submit
 * @param {Event} e - Evento de submit del formulario.
 */
loginForm.addEventListener('submit', async (e) => {
  e.preventDefault()
  await login();
});

/**
 * Función asincrónica encargada de verificar el inicio de sesión.
 * @async
 */
async function login() {
  //Constantes con los datos del login
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const resultado = document.querySelector('.resultado');

  /**
   * Objeto FormData con los datos del inicio de sesión.
   * @type {FormData}
   */
  const formData = new FormData();
  formData.append('email', email);
  formData.append('password', password);
  try {
    const response = await fetch('/login', {
      method: 'POST',
      body: formData,
    });
    if (response.ok) {
      const data = await response.text();
      // Si la respuesta es conectado redireccion al home
      if (data === 'conectado') {
        window.location.href = '/';
      } else {
        resultado.textContent = data;
      }
    } else {
      resultado.textContent = 'Error en la solicitud intentelo mas tarde';
    }
  } catch (error) {
    resultado.textContent = 'Error en la solicitud intentelo mas tarde';
  }
}
