import { test, expect } from 'vitest';

import { add } from './prov.js';

test('should summarize all number values in an array', () => {
	// Arrange
	const numbers = [1, 2];

	// Act
	const result = add(numbers);

	// Assert
	const expectedResult = numbers.reduce(
		(prevValue, curValue) => prevValue + curValue,
		0
	);
	expect(result).toBe(expectedResult);
});

test('should yield NaN if at least one invalid number is provided', () => {
	// Arrange
	const inputs = ['invalid', 10];

	// Act
	const result = add(inputs);

	// Assert
	expect(result).toBeNaN();
});

test('should yield a correct sum if an array of numeric sring values is provided', () => {
	// Arrange
	const numbers = ['1', '2'];

	// Act
	const result = add(numbers);

	// Assert
	const expectedResult = numbers.reduce(
		(prevValue, curValue) => +prevValue + +curValue,
		0
	);
	expect(result).toBe(3);
});

test('should yield 0 if an empty array is provided', () => {
	// Arrange
	const numbers = [];

	// Act
	const result = add(numbers);

	// Assert
	expect(result).toBe(0);
});

test('should throw an error if no value is passed into the fucntion', () => {
	try {
		const result = add();
	} catch (error) {
		expect(error).toBeDefined();
	}
});

test('should throw an error if no value is passed into the function', () => {
	const resultFn = () => {
		add();
	};
	expect(resultFn).toThrow();
});

test('should throw an error if provided with multiple arguments instead of an array', () => {
	// Arrange
	const num1 = 1;
	const num2 = 2;

	// Act
	const resultFn = () => {
		add(num1, num2);
	};

	// Assert
	expect(resultFn).toThrow(/is not iterable/);
});

test('should', () => {
	// Arrange   // Parametry, które użytkownik 'niby' wprowadza
	// Act
	// Assert
});
