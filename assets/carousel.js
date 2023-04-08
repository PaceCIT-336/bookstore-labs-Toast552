let rev = parseInt(getCookie('productIndex')) || 0;
const carousel = document.querySelector('.carousel');
const articles = carousel.querySelectorAll('article');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');

let currentIndex = rev;

prevButton.addEventListener('click', () => {
  currentIndex = (currentIndex - 1 + articles.length) % articles.length;
  updateCarousel();
});

nextButton.addEventListener('click', () => {
  currentIndex = (currentIndex + 1) % articles.length;
  updateCarousel();
});

function updateCarousel() {
  articles.forEach((article, index) => {
    if (index === currentIndex) {
      article.classList.add('active');
    } else {
      article.classList.remove('active');
    }
  });
}

updateCarousel();

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}
