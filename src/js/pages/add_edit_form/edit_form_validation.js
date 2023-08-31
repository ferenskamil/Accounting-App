const addEditform = document.querySelector('.invoice-edit__form');

function addEditFormHandler(e, form) {
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

function emptyFieldsValidation(form = null) {
	const inputs = form.querySelectorAll('input');
	const invalidInputs = [];

	// Add css class to blank fields
	inputs.forEach((input) => {
		input.classList.remove('invoice-edit__form-box-input--empty');

		if (input.value === '') {
			input.classList.add('invoice-edit__form-box-input--empty');

			// Add invalid inputs to invalidInputs array
			invalidInputs.push(input);
		}
	});

	// Return true or false depending on whether validation was successfull
	return invalidInputs.length === 0 ? true : false;
}

addEditform.addEventListener('submit', (e) =>
	addEditFormHandler(e, addEditform)
);