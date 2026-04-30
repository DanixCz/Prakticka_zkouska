document.addEventListener('DOMContentLoaded', function () {
    const resetBtn = document.getElementById('resetBtn');
    const form = document.getElementById('mainForm');
    const slides = Array.from(document.querySelectorAll('.gallery-slide'));
    const dotsContainer = document.querySelector('.gallery-dots');
    const prevButton = document.getElementById('galleryPrev');
    const nextButton = document.getElementById('galleryNext');
    let currentSlide = 0;
    let slideInterval;

    function showSlide(index) {
        slides.forEach((slide, idx) => {
            slide.classList.toggle('active', idx === index);
        });
        const dots = Array.from(document.querySelectorAll('.gallery-dot'));
        dots.forEach((dot, idx) => {
            dot.classList.toggle('active', idx === index);
        });
        currentSlide = index;
    }

    function createDots() {
        if (!dotsContainer) return;
        dotsContainer.innerHTML = '';
        slides.forEach((_, idx) => {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.className = 'gallery-dot';
            dot.setAttribute('aria-label', `Snímek ${idx + 1}`);
            dot.addEventListener('click', () => {
                showSlide(idx);
                resetSlideInterval();
            });
            dotsContainer.appendChild(dot);
        });
    }

    function nextSlide() {
        const nextIndex = (currentSlide + 1) % slides.length;
        showSlide(nextIndex);
    }

    function prevSlide() {
        const prevIndex = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prevIndex);
    }

    function resetSlideInterval() {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 5500);
    }

    if (prevButton) {
        prevButton.addEventListener('click', () => {
            prevSlide();
            resetSlideInterval();
        });
    }

    if (nextButton) {
        nextButton.addEventListener('click', () => {
            nextSlide();
            resetSlideInterval();
        });
    }

    if (resetBtn && form) {
        resetBtn.addEventListener('click', function () {
            form.reset();
        });
    }

    createDots();
    showSlide(0);
    resetSlideInterval();

    const hamburger = document.querySelector('.wrapper-hamburger');
    const nav = document.querySelector('header nav');
    let state = false;

    if (hamburger && nav) {
        hamburger.addEventListener('click', () => {
            if (state === true) {
                hamburger.classList.remove('is-active');
                nav.classList.remove('is-open');
                state = false;
            } else {
                hamburger.classList.add('is-active');
                nav.classList.add('is-open');
                state = true;
            }
        });

        hamburger.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                hamburger.click();
            }
        });

        function ControlWidth() {
            const sirka = window.innerWidth;
            if (sirka > 768) {
                hamburger.classList.remove('is-active');
                nav.classList.remove('is-open');
                state = false;
            }
        }

        window.addEventListener('resize', ControlWidth);
    }
});
