export function getValueFromInput(inputElement) {
	return inputElement.value;
}

export function setMaxLengthInputValue(input, length) {
	input.setAttribute('maxlength', length);
}

export function outputResultInInput(value, input) {
	input.value = value;
}

export function setCursorInTheRightPlaceOfInput(event, input) {
	const cursorPos = input.selectionEnd;
	const startValue = input.value;
	const numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

	if (numbers.includes(event.data)) {
		if (
			startValue.substring(cursorPos, cursorPos + 1) === ' ' ||
			cursorPos === startValue.length
		) {
			input.selectionStart = cursorPos + 1;
			input.selectionEnd = cursorPos + 1;
		} else {
			input.selectionStart = cursorPos;
			input.selectionEnd = cursorPos;
		}
	} else if (event.data !== ' ' && event.data !== null) {
		input.value = startValue;
		input.selectionStart = cursorPos - 1;
		input.selectionEnd = cursorPos - 1;
	}
}
