const jsdom = require('jsdom-global');

// Obtén la ruta completa al archivo test.html
const pathToTestHTML = require('path').resolve(__dirname, 'test.html');

// Configura jsdom-global para cargar el archivo HTML antes de las pruebas
const cleanup = jsdom(
  `<html><head></head><body>${require('fs').readFileSync(pathToTestHTML)}`,
);

// Importa las funciones y variables necesarias desde el módulo que estás probando
const {
  mostrarAnunciosCargados,
  showLoader,
  hideLoader,
  getLoader,
  btnCargarMas,
} = require('./CargarMasAnuncios');

// Espía funciones directamente desde el módulo

// Simula la función fetch
const originalFetch = global.fetch;

beforeEach(() => {
  // Restaura la función fetch original antes de cada prueba
  global.fetch = originalFetch;
});

describe('mostrarAnunciosCargados', () => {
  test('debería agregar anuncios al DOM correctamente', async () => {
    document.body.innerHTML = '<div class="anuncios"></div>';
    const fetchMock = jest.fn(() =>
      Promise.resolve({ ok: true, text: () => 'base64data' }),
    );
    global.fetch = fetchMock;

    const anuncios = [
      {
        creado: '2023-11-27',
        primera_imagen_id: '1',
        anuncio_id: '1',
      },
    ];

    await mostrarAnunciosCargados(anuncios);
    expect(document.querySelector('.anuncio-card')).not.toBeNull();
  });
});

describe('showLoader', () => {
  test('debería mostrar el loader y deshabilitar el botón correctamente', () => {
    showLoader();

    expect(getLoader().classList.contains('visible')).toBe(true);
    expect(btnCargarMas.disabled).toBe(true);
  });
});

describe('hideLoader', () => {
  test('debería ocultar el loader y habilitar el botón correctamente', () => {
    hideLoader();

    expect(getLoader().classList.contains('visible')).toBe(false);
    expect(btnCargarMas.disabled).toBe(false);
  });
});
