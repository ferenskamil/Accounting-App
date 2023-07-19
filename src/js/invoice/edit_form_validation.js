// =============================================
// EDIT FORM VALIDATION
const inputs = document.querySelectorAll('.invoice-edit__form-box input');
const submitBtn = document.querySelector(
	'.invoice-edit__form-box-submit-btn button'
);

const editFormValidation = (e) => {
	let isOK = true;
	inputs.forEach((input) => {
		input.classList.remove('invoice-edit__form-box-input--empty');

		if (input.value === '') {
			input.classList.add('invoice-edit__form-box-input--empty');
			isOK = false;
		}
	});

	// Block submit form if any input is empty
	if (!isOK) e.preventDefault();
	return isOK;
};

submitBtn.addEventListener('click', (e) => editFormValidation(e));

// ============================================================
// SANITIZE VALUE IN BANK ACCOUNT INPUT
const accountNoInput = document.querySelector('#account-no-edit');

const sanitizeAccountNo = (e) => {
	// In the future I can to this with regex
	let accountNo = accountNoInput.value;
	let newSpace;

	if (!parseInt(e.data) && e.data !== '0') {
		accountNo = accountNo.slice(0, -1);
	}

	switch (accountNo.length) {
		case 2:
			newSpace = ''.concat(accountNo.slice(0, 2), ' ');
			break;
		case 7:
			newSpace = ''.concat(accountNo.slice(0, 7), ' ');
			break;
		case 12:
			newSpace = ''.concat(accountNo.slice(0, 12), ' ');
			break;
		case 17:
			newSpace = ''.concat(accountNo.slice(0, 17), ' ');
			break;
		case 22:
			newSpace = ''.concat(accountNo.slice(0, 22), ' ');
			break;
		case 27:
			newSpace = ''.concat(accountNo.slice(0, 27), ' ');
			break;
		case 33:
			accountNo = accountNo.slice(0, -1);
			break;
		default:
			break;
	}

	if (newSpace) {
		accountNo = newSpace;
	}
	accountNoInput.value = accountNo;
};

accountNoInput.addEventListener('input', (e) => sanitizeAccountNo(e));
