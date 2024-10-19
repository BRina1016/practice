document.addEventListener('DOMContentLoaded', function () {
    const menuIcon = document.getElementById('menuIcon');
    const menu = document.getElementById('menu');

    // ハンバーガーメニュークリック時のイベント
    menuIcon.addEventListener('click', () => {
        menuIcon.classList.toggle('open');
        menu.classList.toggle('open');
    });
});
