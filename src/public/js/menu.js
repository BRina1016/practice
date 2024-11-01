document.addEventListener('DOMContentLoaded', function () {
    const menuIcon = document.getElementById('menuIcon');
    const menu = document.getElementById('menu');

    menuIcon.addEventListener('click', () => {
        menuIcon.classList.toggle('open');
        menu.classList.toggle('open');
    });
});
