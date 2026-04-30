document.addEventListener('DOMContentLoaded', function () {
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

    createDots();
    showSlide(0);
    resetSlideInterval();
});
