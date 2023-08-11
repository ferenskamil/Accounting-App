// Change logo depending onf width screen and background-color
const setLogoColor = () => {
	const logo = document.querySelector('.home__top-left img');

	if (window.innerWidth >= 768) {
		logo.src = './dist/img/app_icon_dark.png';
	} else {
		logo.src = './dist/img/app_icon_white.png';
	}
};

document.addEventListener('DOMContentLoaded', setLogoColor);
window.addEventListener('resize', setLogoColor);

/////////////

const userInfo = document.querySelector('.home__top-right-logged-user');
const userInfoSettings = document.querySelector(
	'.home__top-right-logged-user-settings'
);

userInfo.addEventListener('click', () => {
	userInfoSettings.classList.toggle(
		'home__top-right-logged-user-settings--active'
	);
});
