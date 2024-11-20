document.addEventListener('DOMContentLoaded', () => {
    let itemsPerView = 5;

    function moveProductSlide(direction, container, items) {
        if (!container || !items.length) return;

        let currentIndex = parseInt(container.dataset.currentIndex) || 0;
        let nextIndex = currentIndex + direction;

        if (nextIndex < 0 || nextIndex >= items.length - itemsPerView + 1) return;

        items.forEach((item, i) => {
            item.style.transform = `translateX(-${nextIndex * 111}%)`;
        });

        container.dataset.currentIndex = nextIndex;
    }

    document.querySelectorAll(".next").forEach(next => {
        next.addEventListener("click", function () {
            let container = next.closest('.section').querySelector('.product-grid');
            let items = container.querySelectorAll('.book-item');
            moveProductSlide(1, container, items);
        });
    });

    document.querySelectorAll(".prev").forEach(prev => {
        prev.addEventListener("click", function () {
            let container = prev.closest('.section').querySelector('.product-grid');
            let items = container.querySelectorAll('.book-item');
            moveProductSlide(-1, container, items);
        });
    });

    document.querySelectorAll('.product-grid').forEach(container => {
        container.dataset.currentIndex = 0;
    });
});
