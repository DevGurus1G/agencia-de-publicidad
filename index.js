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
  });
});
