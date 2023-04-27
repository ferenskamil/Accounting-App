const burgerBtn = document.querySelector('.burger-btn');
const nav = document.querySelector('.nav');
const main = document.querySelector('.main');

const toggleNav = () => {
	nav.classList.toggle('nav--active');
	burgerBtn.classList.toggle('burger-btn--active');
	main.classList.toggle('main--active');
};

burgerBtn.addEventListener('click', toggleNav);
