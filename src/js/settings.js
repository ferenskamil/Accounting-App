const avatarForm = document.querySelector('.settings__form-change-avatar');
const avatarInput = document.querySelector('#change-avatar-btn');
const logoForm = document.querySelector('.settings__form-change-company-logo');
const logoInput = document.querySelector('#change-logo-btn');

const submitChangeAvatarForm = () => {
	avatarForm.submit();
};

const submitChangeLogoForm = () => {
	logoForm.submit();
};

avatarInput.addEventListener('change', submitChangeAvatarForm);
logoInput.addEventListener('change', submitChangeLogoForm);
