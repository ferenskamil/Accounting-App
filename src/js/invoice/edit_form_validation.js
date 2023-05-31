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

// ============================================================
// SANITIZE VALUE IN BANK ACCOUNT INPUT
const accountNoInput = document.querySelector('#account-no-edit');
const sanitizeAccountNoInput = (e) => {
	// In the future I can to this with regex
	let accountNoString = accountNoInput.value;
	let workString;

	if (!parseInt(e.data) && e.data !== '0') {
		accountNoString = accountNoString.slice(0, -1);
	}

	switch (accountNoString.length) {
		case 2:
			workString = ''.concat(accountNoString.slice(0, 2), ' ');
			break;
		case 7:
			workString = ''.concat(accountNoString.slice(0, 7), ' ');
			break;
		case 12:
			workString = ''.concat(accountNoString.slice(0, 12), ' ');
			break;
		case 17:
			workString = ''.concat(accountNoString.slice(0, 17), ' ');
			break;
		case 22:
			workString = ''.concat(accountNoString.slice(0, 22), ' ');
			break;
		case 27:
			workString = ''.concat(accountNoString.slice(0, 27), ' ');
			break;
		case 33:
			accountNoString = accountNoString.slice(0, -1);
			break;
		default:
			break;
	}

	if (workString) {
		accountNoString = workString;
	}
	accountNoInput.value = accountNoString;
};

accountNoInput.addEventListener('input', (e) => sanitizeAccountNoInput(e));
