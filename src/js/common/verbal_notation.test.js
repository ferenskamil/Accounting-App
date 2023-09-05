import { describe, expect, test } from 'vitest';
import { VerbalNotation } from './verbal_notation.js';

const verb = new VerbalNotation();

describe('toVerbalNotation()', () => {
	describe('different lenght of number string range of 0 to 999999 ', () => {
		test('Should return the verbal notation for number consisting of 1 digit', () => {
			const num = '5';

			const result = verb.toVerbalNotation(num);

			const expectedResult = 'five 00/100 $';
			expect(result).toBe(expectedResult);
		});
		test('Should return the verbal notation for number consisting of 2 digit', () => {
			const num = '43';

			const result = verb.toVerbalNotation(num);

			const expectedResult = 'forty three 00/100 $';
			expect(result).toBe(expectedResult);
		});
		test('Should return the verbal notation for number consisting of 3 digit', () => {
			const num = '456';

			const result = verb.toVerbalNotation(num);

			const expectedResult = 'four hundred fifty six 00/100 $';
			expect(result).toBe(expectedResult);
		});
		test('Should return the verbal notation for number consisting of 4 digit', () => {
			const num = '1001';

			const result = verb.toVerbalNotation(num);

			const expectedResult = 'one thousand one 00/100 $';
			expect(result).toBe(expectedResult);
		});
		test('Should return the verbal notation for number consisting of 5 digit', () => {
			const num = '25346';

			const result = verb.toVerbalNotation(num);

			const expectedResult =
				'twenty five thousand three hundred forty six 00/100 $';
			expect(result).toBe(expectedResult);
		});
		test('Should return the verbal notation for number consisting of 6 digit', () => {
			const num = '654894';

			const result = verb.toVerbalNotation(num);

			const expectedResult =
				'six hundred fifty four thousand eight hundred ninety four 00/100 $';
			expect(result).toBe(expectedResult);
		});
	});

	describe('Numbers >= 11 & <= 19', () => {
		test.each([
			{
				num: 11,
				expected: 'eleven 00/100 $',
			},
			{
				num: 12,
				expected: 'twelve 00/100 $',
			},
			{
				num: 13,
				expected: 'thirteen 00/100 $',
			},
			{
				num: 14,
				expected: 'fourteen 00/100 $',
			},
			{
				num: 15,
				expected: 'fifteen 00/100 $',
			},
			{
				num: 16,
				expected: 'sixteen 00/100 $',
			},
			{
				num: 17,
				expected: 'seventeen 00/100 $',
			},
			{
				num: 18,
				expected: 'eighteen 00/100 $',
			},
			{
				num: 19,
				expected: 'nineteen 00/100 $',
			},
		])(
			'Should return the right verbal notation for number range of 11 to 19',
			({ num, expected }) => {
				const result = verb.toVerbalNotation(num);
				expect(result).toBe(expected);
			}
		);

		test.each([
			{
				num: '0',
				expected: 'zero 00/100 $',
			},
			{
				num: '10',
				expected: 'ten 00/100 $',
			},
			{
				num: '100',
				expected: 'one hundred 00/100 $',
			},
			{
				num: '1000',
				expected: 'one thousand 00/100 $',
			},
			{
				num: '1100',
				expected: 'one thousand one hundred 00/100 $',
			},
			{
				num: '10000',
				expected: 'ten thousand 00/100 $',
			},
			{
				num: '10100',
				expected: 'ten thousand one hundred 00/100 $',
			},
			{
				num: '100000',
				expected: 'one hundred thousand 00/100 $',
			},
			{
				num: '100100',
				expected: 'one hundred thousand one hundred 00/100 $',
			},
		])('Should return $expected for $num', ({ num, expected }) => {
			const result = verb.toVerbalNotation(num);
			expect(result).toBe(expected);
		});
	});

	describe('Different decimal values', () => {
		test('Should display the decimals for a number with two digits after the decimal point', () => {
			const num1 = '12.41';
			const num2 = 12.41;

			const result1 = verb.toVerbalNotation(num1);
			const result2 = verb.toVerbalNotation(num2);

			const expectedResult1 = 'twelve 41/100 $';
			const expectedResult2 = 'twelve 41/100 $';
			expect(result1).toBe(expectedResult1);
			expect(result2).toBe(expectedResult2);
		});
		test('Should display the decimals for a number with one digit after the decimal point', () => {
			const num = 12.4;

			const result = verb.toVerbalNotation(num);

			const expectedResult = 'twelve 40/100 $';
			expect(result).toBe(expectedResult);
		});

		test('Should round the decimals for a number with 3 digits after the decimal point', () => {
			const num1 = '14.143';
			const num2 = '14.145';

			const result1 = verb.toVerbalNotation(num1);
			const result2 = verb.toVerbalNotation(num2);

			const expectedResult1 = 'fourteen 14/100 $';
			const expectedResult2 = 'fourteen 15/100 $';
			expect(result1).toBe(expectedResult1);
			expect(result2).toBe(expectedResult2);
		});
	});
});

describe('validateType()', () => {
	test.each([
		{
			val: [],
		},
		{
			val: {},
		},
		{
			val: undefined,
		},
		{
			val: NaN,
		},
		{
			val: null,
		},
	])('should throw error for non transformable values ($val)', ({ val }) => {
		const resultFn = () => verb.validateType(val);

		expect(resultFn).toThrowError();
	});

	// test('Should throw error for negative value', () => {
	// 	const num1 = '-1';
	// 	const num2 = -1;

	// 	const resultFn1 = () => verb.validateType(num1);
	// 	const resultFn2 = () => verb.validateType(num2);

	// 	expect(resultFn1).toThrow();
	// 	expect(resultFn2).toThrow();
	// });
	// test('Should throw error for number of 7 digits', () => {
	// 	const num1 = '1000000';
	// 	const num2 = 1000000;

	// 	const resultFn1 = () => verb.validateType(num1);
	// 	const resultFn2 = () => verb.validateType(num2);

	// 	// expect('test').toBe(verb.validateType(num1))
	// 	// expect('test').toBe(verb.validateType(num2))

	// 	expect(resultFn1).toThrow();
	// 	expect(resultFn2).toThrow();
	// });

	test('should not throw error for string types', () => {
		const input = '5';

		const resultFn = () => {
			verb.validateType(input);
		};

		expect(resultFn).not.toThrow();
	});

	test('should not throw error for numbers', () => {
		const input = 5;

		const resultFn = () => {
			verb.validateType(input);
		};

		expect(resultFn).not.toThrow();
	});
});

describe('sanitizeNumberString()', () => {
	test('Should yield string for number as parameter', () => {
		const num = 5;

		const result = verb.sanitizeNumberString(num);

		expect(result).toBeTypeOf('string');
	});
	test('Should remove redundant zeros if they are at the beginning of the string', () => {
		const input = '00005';

		const result = verb.sanitizeNumberString(input);

		const expectedResult = '5';
		expect(result).toBe(expectedResult);
	});
	test('Should not remove the zero at the beginning if it is the only digit', () => {
		const input = '0.1';

		const result = verb.sanitizeNumberString(input);

		const expectedResult = '0.1';
		expect(result).toBe(expectedResult);
	});

	test('Should remove the second dot and all characters after it. ', () => {
		const input = '55.6.85';

		const result = verb.sanitizeNumberString(input);

		const expectedResult = '55.6';
		expect(result).toBe(expectedResult);
	});

	test('Should yield string number with dot for string number with comma', () => {
		const input = '55,64';

		const result = verb.sanitizeNumberString(input);

		const expectedResult = '55.64';
		expect(result).toBe(expectedResult);
	});
	test('Should not remove the zero at the beginning if it is followed by a comma or a dot, followed by a digit', () => {});

	test.each([
		{ input: '1 000', expected: '1000' },
		{ input: '54 654', expected: '54654' },
		{ input: ' 1 2 3 4 5 6', expected: '123456' },
	])(
		'Should read the number correctly, even if the digits are separated by spaces ("$input" => "$expected")',
		({ input, expected }) => {
			const result = verb.sanitizeNumberString(input);

			expect(result).toBe(expected);
		}
	);
	test('Should accept a parameter if there are letters behind the numbers', () => {
		const input = '1 USD';

		const result = verb.sanitizeNumberString(input);

		const expectedResult = '1';
		expect(result).toBe(expectedResult);
	});
	test('Should convert negative number for positive number', () => {
		const input = '-5';

		const result = verb.sanitizeNumberString(input);

		const expectedResult = '5';
		expect(result).toBe(expectedResult);
	});
});

describe('getWholeNumber()', () => {
	test('Should yield string with whole number for decimals', () => {
		const input1 = '64.45';
		const input2 = '64.4';

		const result1 = verb.getWholeNumber(input1);
		const result2 = verb.getWholeNumber(input2);

		const expectedResult1 = '64';
		const expectedResult2 = '64';
		expect(result1).toBe(expectedResult1);
		expect(result2).toBe(expectedResult2);
	});

	test('Should yield string type value', () => {
		const input1 = '64';
		const input2 = 64;

		const result1 = verb.getWholeNumber(input1);
		const result2 = verb.getWholeNumber(input2);

		expect(result1).toBeTypeOf('string');
		expect(result2).toBeTypeOf('string');
	});
	test.each([
		{ input: '64', expected: '64' },
		{ input: 64, expected: '64' },
	])(
		'Should return a string with an integer for an integer',
		({ input, expected }) => {
			const result = verb.getWholeNumber(input);
			expect(result).toBe(expected);
		}
	);
});

describe('getTenths()', () => {
	test('Should yield "00" for integer', () => {});
	test('Should yield a two-digit remainder for a number with one digit after the decimal point ', () => {});
	test('Should yield a two-digit remainder for a number with three digits after the decimal point ', () => {});
	test.each([
		{ val: '5.2', expected: '20' },
		{ val: '5.24', expected: '24' },
		{ val: '5.241', expected: '24' },
	])(
		'Should yield string with tenths of passed number',
		({ val, expected }) => {
			const result = verb.getTenths(val);

			expect(result).toBe(expected);
		}
	);
	test('Should round the number to two decimal places according to the rules of mathematics', () => {
		const input = '5.427';

		const result = verb.getTenths(input);

		const expectedResult = '43';
		expect(result).toBe(expectedResult);
	});
});

describe('divideStringToParts()', () => {
	test.each([
		{ input: '12345678', partLength: 3, expected: ['12', '345', '678'] },
		{ input: '1234567', partLength: 3, expected: ['1', '234', '567'] },
	])(
		'If the number of characters is indivisible by the parameter "partLength" then the element with index zero should have a smaller number of characters )',
		({ input, partLength, expected }) => {
			const result = verb.divideStringToParts(input, partLength);

			expect(result).toStrictEqual(expected);
		}
	);
	test('Should divide the string into elements of the given length and return an array with these elements', () => {
		const input = '123456789';
		const partLth = 3;

		const result = verb.divideStringToParts(input, partLth);

		const expectedResult = ['123', '456', '789'];
		expect(result).toStrictEqual(expectedResult);
	});
	test('should return an array', () => {
		const input = '1';
		const partLth = 3;

		// const testArray = new Array();
		const result = verb.divideStringToParts(input, partLth);

		expect(result).toBeInstanceOf(Array);
	});
	test('Any element in returned array should not be empty string', () => {
		const input = 'abc';
		const partLth = 3;

		const result = verb.divideStringToParts(input, partLth);

		const isAnyPartEmpty = result.includes('');
		expect(isAnyPartEmpty).toBeFalsy();
	});
	test('Length of any array element should not be more than "partLength" parameter', () => {
		const input = '111111111';
		const partLth = 3;

		const result = verb.divideStringToParts(input, partLth);

		const maxPartLength = result.reduce(
			(maxLength, el) => Math.max(maxLength, el.length),
			0
		);
		expect(maxPartLength).toBeLessThanOrEqual(partLth);
	});
});

describe.todo('verbalNotationOfThreeDigitNumber()', () => {});

describe.todo('concatPartsToVerbalNotation()', () => {});

describe.todo(
	'zaokrąglijzgodnie za matematyką do danego miejsca po przecinku()',
	() => {}
);
