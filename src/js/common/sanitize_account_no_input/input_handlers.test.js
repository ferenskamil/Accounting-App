import { describe, test, expect, vi, beforeEach, beforeAll } from 'vitest';
// import fs from 'fs';
// import path from 'path';
import { Window } from 'happy-dom';

import {
	getValueFromInput,
	setInputMaxLength,
	outputResultInInput,
	setCursorInTheRightPlaceOfInput,
} from './input_handlers.js';

const inputHtml = '<input type="text" id="account-no" >';

const window = new Window({});
const document = window.document;
document.write(inputHtml);
vi.stubGlobal('document', document);

const testInput = document.querySelector('#account-no');

describe('getValueFromInput()', () => {
	beforeEach(() => {
		testInput.value = '';
	});

	test('should return a string with the value of the input', () => {
		const testValue = 'lorem ipsum';

		testInput.value = testValue;
		const result = getValueFromInput(testInput);

		const expectedResult = testInput.value;
		expect(result).toBe(expectedResult);
	});

	test('should return string type', () => {
		const testValue = 'lorem ipsum';

		testInput.value = testValue;
		const result = getValueFromInput(testInput);

		const expectedResult = testInput.value;
		expect(result).toBeTypeOf('string');
	});
});

describe('setInputMaxLength()', () => {
	beforeEach(() => {
		testInput.removeAttribute('maxLength');
	});

	test('should change input "maxLength" attribute to specified value', () => {
		const newMaxLength = 26;

		setInputMaxLength(testInput, newMaxLength);

		const changedMaxLenght = parseInt(testInput.getAttribute('maxLength'));
		expect(changedMaxLenght).toBe(newMaxLength);
	});
});

describe('outputResultInInput()', () => {
	beforeEach(() => {
		testInput.value = '';
	});

	test('should change input value for specified value', () => {
		const testString = 'Lorem ipsum dolor es';

		outputResultInInput(testInput, testString);

		const newValue = testInput.value;
		const expectedValue = testString;
		expect(newValue).toBe(testString);
	});
});

describe('setCursorInTheRightPlaceOfInput()', () => {
	test('should move cursor one position right after entering a number', () => {
	});

	test('the character behind cursor should be entered number, when you enter a number', () => {});

	test('the input value should not change, when you enter character other than number', () => {});

	test('cursors position should not change, when you enter character other than number', () => {});
});
// 	const mockInput = {
// 		selectionStart: 0,
// 		selectionEnd: 0,
// 		value: '',
// 	};

// 	test('should move cursor one position right after entering a number', () => {
// 		const mockEvent = { data: '1' };
// 		setCursorInTheRightPlaceOfInput(mockEvent, mockInput);

// 		expect(mockInput.selectionStart).toBe(1);
// 		expect(mockInput.selectionEnd).toBe(1);
// 	});

// 	test('should not move cursor if next character is not a space or end of input', () => {
// 		mockInput.value = '1234';
// 		mockInput.selectionStart = 1;
// 		const mockEvent = { data: '5' };
// 		setCursorInTheRightPlaceOfInput(mockEvent, mockInput);

// 		expect(mockInput.selectionStart).toBe(1);
// 		expect(mockInput.selectionEnd).toBe(1);
// 	});

// 	test('should move cursor one position right if next character is a space', () => {
// 		mockInput.value = '1234 5678';
// 		mockInput.selectionStart = 4;
// 		const mockEvent = { data: '6' };
// 		setCursorInTheRightPlaceOfInput(mockEvent, mockInput);

// 		expect(mockInput.selectionStart).toBe(6);
// 		expect(mockInput.selectionEnd).toBe(6);
// 	});

// 	test('should move cursor to the end if input is at the end and next character is a number', () => {
// 		mockInput.value = '1234';
// 		mockInput.selectionStart = 4;
// 		const mockEvent = { data: '5' };
// 		setCursorInTheRightPlaceOfInput(mockEvent, mockInput);

// 		expect(mockInput.selectionStart).toBe(5);
// 		expect(mockInput.selectionEnd).toBe(5);
// 	});

// 	test('should move cursor one position left after entering a non-number character', () => {
// 		mockInput.value = '1234';
// 		mockInput.selectionStart = 2;
// 		const mockEvent = { data: ' ' };
// 		setCursorInTheRightPlaceOfInput(mockEvent, mockInput);

// 		expect(mockInput.selectionStart).toBe(1);
// 		expect(mockInput.selectionEnd).toBe(1);
// 	});

// 	test('should not move cursor if entering a space character', () => {
// 		mockInput.value = '1234';
// 		mockInput.selectionStart = 2;
// 		const mockEvent = { data: ' ' };
// 		setCursorInTheRightPlaceOfInput(mockEvent, mockInput);

// 		expect(mockInput.selectionStart).toBe(1);
// 		expect(mockInput.selectionEnd).toBe(1);
// 	});
// });
