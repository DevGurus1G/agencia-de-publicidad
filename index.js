document.addEventListener('DOMContentLoaded', function () {
  const menuToggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('nav ul');
  console.log(nav);
  menuToggle.addEventListener('click', function () {
    nav.classList.toggle('show');
  });
});
