document.addEventListener('DOMContentLoaded', function () {
    const hamburger = document.querySelector('.wrapper-hamburger');
    const nav = document.querySelector('header nav');
    let state = false;

    if (!hamburger || !nav) {
        return;
    }

    function closeMenu() {
        hamburger.classList.remove('is-active');
        nav.classList.remove('is-open');
        state = false;
    }

    function openMenu() {
        hamburger.classList.add('is-active');
        nav.classList.add('is-open');
        state = true;
    }

    hamburger.addEventListener('click', function () {
        if (state === true) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    hamburger.addEventListener('keydown', function (event) {
        if (event.key === 'Enter' || event.key === ' ') {
            event.preventDefault();
            hamburger.click();
        }
    });

    function handleResize() {
        if (window.innerWidth > 768) {
            closeMenu();
        }
    }

    window.addEventListener('resize', handleResize);
});
