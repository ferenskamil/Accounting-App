const userInfo = document.querySelector('.home__top-right-logged-user');
const userInfoSettings = document.querySelector(
	'.home__top-right-logged-user-settings'
);

userInfo.addEventListener('click', () => {
	userInfoSettings.classList.toggle(
		'home__top-right-logged-user-settings--active'
	);
});
