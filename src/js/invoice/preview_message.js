const closeMessage = (e) => {
	if (
		e.target.className === 'invoice__message-close' ||
		e.target.parentElement.className === 'invoice__message-close'
	) {
		e.target.closest('.invoice__message').style.display = 'none';
	}
};

document.addEventListener('click', closeMessage);
