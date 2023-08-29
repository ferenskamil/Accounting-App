import {
	getValueFromInput,
	sanitizeAccountNo,
	setMaxLengthInputValue,
	outputResultInInput,
	setCursorInTheRightPlaceOfInput,
} from './account_no_input/account_no_input_handler.js';

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
