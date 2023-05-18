// OPEN / HIDE EDIT FORM

const invoiceEditBtn = document.querySelector('.invoice__settings-edit');
const invoiceEditBackBtn = document.querySelector('.invoice__edit-back');
const invoiceEditForm = document.querySelector('.invoice__edit');
const invoiceView = document.querySelector('.invoice__container');
const invoiceSettings = document.querySelector('.invoice__settings');

const openInvoiceEditForm = () => {
	invoiceEditForm.style.display = 'block';
	invoiceView.style.display = 'none';
	invoiceSettings.style.display = 'none';
};

const closeInvoiceEditForm = () => {
	invoiceEditForm.style.display = 'none';
	invoiceView.style.display = 'flex';
	invoiceSettings.style.display = 'flex';
};

invoiceEditBtn.addEventListener('click', openInvoiceEditForm);
invoiceEditBackBtn.addEventListener('click', closeInvoiceEditForm);

// =============================================
// EDIT FORM VALIDATION
const allInputs = document.querySelectorAll('.invoice__edit-form-box input');
const submitBtnEditForm = document.querySelector(
	'.invoice__edit-form-box-submit-btn button'
);

const validationInvoiceEditForm = (e) => {
	let isOK = true;
	allInputs.forEach((input) => {
		input.classList.remove('invoice__edit-form-box-input--empty');

		if (input.value === '') {
			input.classList.add('invoice__edit-form-box-input--empty');
			isOK = false;
		}
	});

	// Block submit form if any input is empty
	if (!isOK) e.preventDefault();

	return isOK;
};
submitBtnEditForm.addEventListener('click', (e) =>
validationInvoiceEditForm(e)
);

// ============================================================
// NOTES
// key shortcuts for testing
// const keyShortcuts = (e) => {
// 	if (e.key === 'Enter') {
// 		alert('test');
// 	}
// };
// document.addEventListener('keydown', (e) => keyShortcuts(e));