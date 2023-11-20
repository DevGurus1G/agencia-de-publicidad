document.addEventListener('DOMContentLoaded', function () {
  const modo = document.querySelector('.modo');
  const menuToggle = document.querySelector('.menu-toggle');
  const menuFilter = document.querySelector('.menu-filter');
  const navMenu = document.querySelector('.navMenu');
  const navFilter = document.querySelector('.navFilter');

  menuToggle.addEventListener('click', function () {
    navMenu.classList.toggle('show');
  });

  menuFilter.addEventListener('click', function () {
    navFilter.classList.toggle('show');
  });

  modo.addEventListener('click', function () {
    document.querySelector('body').classList.toggle('dark');
    let modo;
    let fechaExpiracion = new Date();
    // Añade 3 meses en milisegundos (3 meses * 30 días * 24 horas * 60 minutos * 60 segundos * 1000 milisegundos)
    fechaExpiracion.setTime(fechaExpiracion.getTime() + (3 * 30 * 24 * 60 * 60 * 1000));
    fechaExpiracion = fechaExpiracion.toUTCString();
    document.body.classList.contains("dark") ?  modo = "dark": modo="light" ;
    document.cookie = "modo=" + modo + "; expires=" + fechaExpiracion + "; path=/";
  });
});
