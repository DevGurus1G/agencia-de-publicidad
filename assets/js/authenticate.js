const loginForm = document.getElementById('login-form');
const registroForm = document.getElementById('registro-form');

loginForm.addEventListener('submit', (e) => e.preventDefault());
registroForm.addEventListener('submit', (e) => e.preventDefault());

// Listener botones submit para el POST

const loginBtn = document.getElementById('login-btn');
const registroBtn = document.getElementById('registro-btn');

loginBtn.addEventListener('click', login);
registroBtn.addEventListener('click', registro);

async function login() {
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const tipo = loginForm.querySelector("input[type='hidden']").value;
  const resultado = document.querySelector('.resultado');

  console.log(tipo);

  const formData = new FormData();
  formData.append('email', email);
  formData.append('password', password);
  formData.append('tipo', tipo);
  // Validaciones
  try {
    const response = await fetch('authenticate.php', {
      method: 'POST',
      body: formData,
    });
    if (response.ok) {
      const data = await response.text();
      console.log(data);
      if (data === 'conectado') {
        window.location.href = './index.php';
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

async function registro() {
  const nombre = document.getElementById('nombre-reg').value;
  const apellidos = document.getElementById('apellidos-reg').value;
  const email = document.getElementById('email-reg').value;
  const username = document.getElementById('username-reg').value;
  const password = document.getElementById('password-reg').value;
  const imagen = document.getElementById('imagen').files[0];
  const tipoUsuario = document.querySelector(
    "input[type='radio']:checked",
  ).value;
  const tipo = registroForm.querySelector("input[type='hidden']").value;
  console.log(tipo);
  const resultado = document.querySelector('.resultado');

  const formData = new FormData();
  formData.append('nombre', nombre);
  formData.append('apellidos', apellidos);
  formData.append('email', email);
  formData.append('username', username);
  formData.append('password', password);
  formData.append('imagen', imagen);
  formData.append('tipoUsuario', tipoUsuario);
  formData.append('tipo', tipo);

  try {
    const response = await fetch('authenticate.php', {
      method: 'POST',
      body: formData, // Use FormData instead of JSON.stringify
    });
    if (response.ok) {
      const data = await response.text();
      if (data === 'registrado') window.location.href = './index.php';
    } else {
      console.error(response);
    }
  } catch (error) {
    resultado.textContent = 'Error en la solicitud intentelo mas tarde';
  }
}
