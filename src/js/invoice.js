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
	// prevent default only for testing
	e.preventDefault();

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

// =============================================
// TRANSFERRING DATA FROM EDIT FORM TO PREVIEW

const transferDataFromEditFormToPreview = () => {
	const invoiceNoEditForm = document.querySelector('#invoice-no-edit').value;
	const dateEditForm = document.querySelector('#date-edit').value;
	const cityEditForm = document.querySelector('#city-edit').value;
	const bankEditForm = document.querySelector('#bank-edit').value;
	const accountNoEditForm = document.querySelector('#account-no-edit').value;
	const termEditForm = document.querySelector('#term-edit').value;

	const sellerNameEditForm =
		document.querySelector('#seller-name-edit').value;
	const sellerAddress1EditForm = document.querySelector(
		'#seller-address1-edit'
	).value;
	const sellerAddress2EditForm = document.querySelector(
		'#seller-address2-edit'
	).value;
	const sellerNIPEditForm = document.querySelector('#seller-NIP-edit').value;

	const customerNameEditForm = document.querySelector(
		'#customer-name-edit'
	).value;
	const customerAddress1EditForm = document.querySelector(
		'#customer-address1-edit'
	).value;
	const customerAddress2EditForm = document.querySelector(
		'#customer-address2-edit'
	).value;
	const customerNIPEditForm =
		document.querySelector('#customer-NIP-edit').value;

	const commentTextAreaEditForm =
		document.querySelector('#comment-edit').value;

	let invoiceNoView = document.querySelector('#invoice-no-view');
	let dateView = document.querySelector('#date-view');
	let cityView = document.querySelector('#city-view');
	let bankView = document.querySelector('#bank-view');
	let accountNoView = document.querySelector('#account-no-view');
	let termView = document.querySelector('#term-view');

	let sellerNameView = document.querySelector('#seller-name-view');
	let sellerAddress1View = document.querySelector('#seller-address1-view');
	let sellerAddress2View = document.querySelector('#seller-address2-view');
	let sellerNIPView = document.querySelector('#seller-NIP-view');

	let customerNameView = document.querySelector('#customer-name-view');
	let customerAddress1View = document.querySelector(
		'#customer-address1-view'
	);
	let customerAddress2View = document.querySelector(
		'#customer-address2-view'
	);
	let customerNIPView = document.querySelector('#customer-NIP-view');

	const commentTextAreaView = document.querySelector('#comment-view');

	invoiceNoView.textContent = invoiceNoEditForm;
	dateView.textContent = dateEditForm;
	cityView.textContent = cityEditForm;
	bankView.textContent = bankEditForm;
	accountNoView.textContent = accountNoEditForm;
	termView.textContent = termEditForm;

	sellerNameView.textContent = sellerNameEditForm;
	sellerAddress1View.textContent = sellerAddress1EditForm;
	sellerAddress2View.textContent = sellerAddress2EditForm;
	sellerNIPView.textContent = sellerNIPEditForm;

	customerNameView.textContent = customerNameEditForm;
	customerAddress1View.textContent = customerAddress1EditForm;
	customerAddress2View.textContent = customerAddress2EditForm;
	customerNIPView.textContent = customerNIPEditForm;

	commentTextAreaView.textContent = commentTextAreaEditForm;
};

submitBtnEditForm.addEventListener('click', transferDataFromEditFormToPreview);

// =============================================
// DISPLAY (OR NOT) EDIT FORM AFTER LOAD PAGE

const editFormOnLoaded = (e) => {
	if (!validationInvoiceEditForm(e)) {
		openInvoiceEditForm();
	} else {
		transferDataFromEditFormToPreview();
	}
};

document.addEventListener('DOMContentLoaded', (e) => editFormOnLoaded(e));

// ============================================================
// NOTES
// key shortcuts for testing
// const keyShortcuts = (e) => {
// 	if (e.key === 'Enter') {
// 		alert('test');
// 	}
// };
// document.addEventListener('keydown', (e) => keyShortcuts(e));
