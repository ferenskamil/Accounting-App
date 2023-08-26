const closeMessage = (e) => {
	if (
		e.target.className === 'close-pop-up' ||
		e.target.parentElement.className === 'close-pop-up'
	) {
		e.target.closest('.pop-up').style.display = 'none';
	}
};

document.addEventListener('click', closeMessage);
