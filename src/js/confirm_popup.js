const deleteBtns = document.querySelectorAll('.delete-btn');
const returnBtn = document.querySelector('.confirm__pop-up-buttons-return');

const showConfirmPopup = (e) => {
	const popup = document.querySelector('.confirm__shadow');
	const popupInvoiceNoSpan = popup.querySelector(
		'.confirm__pop-up-message p span'
	);
	const invoiceNoHidden = document.querySelector(
		'#pop-up-invoice-no-hidden-input'
	);
	let invoiceNo;

	// Invoice no. will be fetched from a different location depending on the file we are in
	if (e.target.closest('.invoice-list')) {
		const item = e.target.closest('.invoice-list__table-tbody-item');
		invoiceNo = item.querySelector(
			'td:nth-child(1) span:nth-child(2)'
		).textContent;
	} else if (e.target.closest('.invoice')) {
		invoiceNo = document.querySelector(
			'.invoice__paper-title span'
		).textContent;
	}

	popupInvoiceNoSpan.textContent = invoiceNo;
	invoiceNoHidden.value = invoiceNo;
	popup.classList.add('confirm__shadow--active');
};

const hideConfirmPopup = () => {
	const popup = document.querySelector('.confirm__shadow');
	popup.classList.remove('confirm__shadow--active');
};

deleteBtns.forEach((btn) => {
	btn.addEventListener('click', (e) => showConfirmPopup(e));
});
returnBtn.addEventListener('click', hideConfirmPopup);
