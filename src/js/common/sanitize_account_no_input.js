import {
	getValueFromInput,
	sanitizeAccountNo,
	setMaxLengthInputValue,
	outputResultInInput,
	setCursorInTheRightPlaceOfInput,
} from './sanitize_account_no_input/input_handlers.js';

const accountNoInput = document.querySelector('#account-no');

function accountNoInputHandler(event, input) {
	const inputValue = getValueFromInput(input);
	const accountNo = sanitizeAccountNo(inputValue);
	setMaxLengthInputValue(input, 32);
	outputResultInInput(accountNo, input);
	setCursorInTheRightPlaceOfInput(event, input);
}

accountNoInput.addEventListener('input', (e) =>
	accountNoInputHandler(e, accountNoInput)
);
