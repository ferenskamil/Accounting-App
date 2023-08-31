export function formValidation(e, form) {
	// block send form before validation
	e.preventDefault();

	// validation
	if (emptyFieldsValidation(form)) {
		// Send form
		form.submit();
	} else {
		// Throw error
		throw new Error('Cannot submit form. No field can be empty.');
	}
}

export function emptyFieldsValidation(form) {
	const inputs = form.querySelectorAll('input');
	const invalidInputs = [];

	// Nadaj klasę wskazującą na nieprawidłowe wypełnienie
	inputs.forEach((input) => {
		input.classList.remove('invoice-edit__form-box-input--empty');

		if (input.value === '') {
			input.classList.add('invoice-edit__form-box-input--empty');
			invalidInputs.push(input);
		}
	});

	return invalidInputs.length === 0 ? true : false;
}
