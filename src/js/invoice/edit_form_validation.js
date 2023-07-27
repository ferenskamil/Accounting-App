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
const accountNoInput = document.querySelector('#account-no');

const insertSpacesIntoAccountNo = (
	accountNoString,
	firstSplit = 2,
	eachNextSplit = 4
) => {
	// delete spaces
	accountNoString = accountNoString.replace(/ /g, '');

	// insert spaces in the correct places
	const parts = [];
	parts.push(accountNoString.substring(0, firstSplit));
	accountNoString = accountNoString.substring(firstSplit);

	do {
		parts.push(accountNoString.substring(0, eachNextSplit));
		accountNoString = accountNoString.slice(eachNextSplit);
	} while (accountNoString.length > 0);

	// return string
	return parts.filter((part) => part !== '').join(' ');
};

const sanitizeAccountNo = (e) => {
	// In the future I can to this with regex
	let accountNo = accountNoInput.value;
	let testVar = accountNoInput.selectionEnd;
	accountNoInput.setAttribute('maxlength', 32);

	// delete spaces, letters and special characters 
	accountNo = accountNo.replace(/[^0-9 ]/g, '');

	if (['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'].includes(e.data)) {
		accountNoInput.value = insertSpacesIntoAccountNo(accountNo);

		if (
			accountNo.substring(testVar, testVar + 1) === ' ' ||
			testVar === accountNo.length
		) {
			accountNoInput.selectionStart = testVar + 1;
			accountNoInput.selectionEnd = testVar + 1;
		} else {
			accountNoInput.selectionStart = testVar;
			accountNoInput.selectionEnd = testVar;
		}
	} else if (e.data !== ' ' && e.data !== null) {
		accountNoInput.value = accountNo;
		accountNoInput.selectionStart = testVar - 1;
		accountNoInput.selectionEnd = testVar - 1;
	}
};

accountNoInput.addEventListener('input', (e) => sanitizeAccountNo(e));
