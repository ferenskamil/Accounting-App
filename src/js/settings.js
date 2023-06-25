const avatarForm = document.querySelector('.settings__form-change-avatar');
const avatarInput = document.querySelector('#upload-img-btn');

const submitUploadAvatarForm = () => {
	avatarForm.submit();
};

avatarInput.addEventListener('change', submitUploadAvatarForm);
