const burgerBtn = document.querySelector('.burger-btn');
const nav = document.querySelector('.nav');
const main = document.querySelector('.main');
const topbar = document.querySelector('.topbar');
const shadow = document.querySelector('.shadow');

const toggleNav = () => {
	nav.classList.toggle('nav--active');
	burgerBtn.classList.toggle('burger-btn--active');
	main.classList.toggle('main--active');
	topbar.classList.toggle('topbar--active');
	shadow.classList.toggle('shadow--active');
};

burgerBtn.addEventListener('click', toggleNav);