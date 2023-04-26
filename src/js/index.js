const burgerBtn = document.querySelector('.burger-btn');
const nav = document.querySelector('.nav');

const toggleNav = () => {
	nav.classList.toggle('nav--active');
	burgerBtn.classList.toggle('burger-btn--active');
};

burgerBtn.addEventListener('click', toggleNav);
