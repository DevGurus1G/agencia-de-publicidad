const loginForm = document.querySelector('form');
const btnLogin = document.getElementById('login-btn');

loginForm.addEventListener('submit', (e) => e.preventDefault());
btnLogin.addEventListener('click', login);

async function login() {
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const resultado = document.querySelector('.resultado');

  const formData = new FormData();
  formData.append('email', email);
  formData.append('password', password);
  // Validaciones
  try {
    const response = await fetch('/login', {
      method: 'POST',
      body: formData,
    });
    if (response.ok) {
      const data = await response.text();
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
