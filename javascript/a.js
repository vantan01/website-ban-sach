let slideCurrentIndex = 0;
const slidesContainer = document.querySelector('.slides');
const slides = document.querySelectorAll('.slide');
const dotsContainer = document.querySelector('.dots');

function createDots(items) {
    items.forEach((_, index) => {
        const dot = document.createElement('span');
        dot.classList.add('dot');
        dot.addEventListener('click', () => showSlide(index));
        dotsContainer.appendChild(dot);
    });
}

function showSlide(index) {
    slideCurrentIndex = (index + slides.length) % slides.length;
    slidesContainer.style.transform = `translateX(-${slideCurrentIndex * 100}%)`;
    dotsContainer.querySelectorAll('.dot').forEach((dot, i) => {
        dot.classList.toggle('active', i === slideCurrentIndex);
    });
}

function autoSlide() {
    moveSlide(1);
    setTimeout(autoSlide, 3000);
}

function moveSlide(direction) {
    showSlide(slideCurrentIndex + direction);
}

document.addEventListener('DOMContentLoaded', () => {
    createDots(slides);
    showSlide(0);
    autoSlide();
});
