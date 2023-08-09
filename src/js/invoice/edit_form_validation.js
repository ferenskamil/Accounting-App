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
	// if (!isOK) e.preventDefault();
	return isOK;
};

submitBtn.addEventListener('click', (e) => editFormValidation(e));