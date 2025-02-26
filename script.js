const carouselItems = document.querySelectorAll('.carousel-item');
const prevButton = document.querySelector('.carousel-prev');
const nextButton = document.querySelector('.carousel-next');
let currentItem = 0;

function showItem(index) {
    carouselItems.forEach((item, i) => {
        if (i === index) {
            item.classList.add('active');
        } else {
            item.classList.remove('active');
        }
    });
}

function nextItem() {
    currentItem = (currentItem + 1) % carouselItems.length;
    showItem(currentItem);
}

function prevItem() {
    currentItem = (currentItem - 1 + carouselItems.length) % carouselItems.length;
    showItem(currentItem);
}

nextButton.addEventListener('click', nextItem);
prevButton.addEventListener('click', prevItem);

showItem(currentItem);