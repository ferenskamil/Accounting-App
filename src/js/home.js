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

/*
When a user enters the home page logged in, there will be an option 
to open a window with options after clicking on the avatar. 
The item is available only when the user is logged in. */
const showUserOptions = () => {
	const userInfoSettings = document.querySelector(
		'.home__top-right-logged-user-settings'
	);

	userInfoSettings.classList.toggle(
		'home__top-right-logged-user-settings--active'
	);
};

if (document.querySelector('.home__top-right-logged-user')) {
	const userInfo = document.querySelector('.home__top-right-logged-user');
	userInfo.addEventListener('click', showUserOptions);
}
