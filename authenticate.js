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
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  // Validaciones
  try {
    const response = await fetch('authenticate.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        username,
        password,
      }),
    });
    const resultado = document.querySelector('.resultado');
    if (response.ok) {
      const data = await response.text();
      console.log(data);
      if (data === 'conectado') {
        window.location.href = '/index.php';
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

function registro() {}
