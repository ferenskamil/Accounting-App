import { describe, expect, test } from 'vitest';
import { toVerbalNotation } from './verbal_notation.js';

const verb = new toVerbalNotation();

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

	describe('Risky numbers', () => {
		test.each([
			{
				num: 11,
				expected: 'eleven 00/100$',
			},
			{
				num: 12,
				expected: 'twelve 00/100$',
			},
			{
				num: 13,
				expected: 'thirteen 00/100$',
			},
			{
				num: 14,
				expected: 'fourteen 00/100$',
			},
			{
				num: 15,
				expected: 'fifteen 00/100$',
			},
			{
				num: 16,
				expected: 'sixteen 00/100$',
			},
			{
				num: 17,
				expected: 'seventeen 00/100$',
			},
			{
				num: 18,
				expected: 'eighteen 00/100$',
			},
			{
				num: 1,
				expected: 'nineteen 00/100$',
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
				num: '10',
				expected: 'ten 00/100$',
			},
			{
				num: '100',
				expected: 'one hundred 00/100$',
			},
			{
				num: '1000',
				expected: 'one thousand 00/100$',
			},
			{
				num: '1100',
				expected: 'one thousand one hundred 00/100$',
			},
			{
				num: '10000',
				expected: 'ten thousand 00/100$',
			},
			{
				num: '10100',
				expected: 'ten thousand one hundred 00/100$',
			},
			{
				num: '100000',
				expected: 'one hundred thousand 00/100$',
			},
			{
				num: '100100',
				expected: 'one hundred thousand one hundred 00/100$',
			},
		])('Should return $expected for $num', ({ num, expected }) => {
			const result = verb.toVerbalNotation(num);
			expect(result).toBe(expected);
		});
	});

	describe('Boundary values', () => {
		test('Should throw error for number of 7 digits', () => {
			const num1 = '1000000';
			const num2 = 1000000;

			const resultFn1 = () => verb.toVerbalNotation(num1);
			const resultFn2 = () => verb.toVerbalNotation(num2);

			expect(resultFn1).toThrow();
			expect(resultFn2).toThrow();
		});
		test('Should pass zero as value', () => {
			const num1 = '0';
			const num2 = 0;

			const result1 = verb.toVerbalNotation(num1);
			const result2 = verb.toVerbalNotation(num2);

			const expectedResult1 = 'zero 00/PLN $';
			const expectedResult2 = 'zero 00/PLN $';
			expect(result1).toBe(expectedResult1);
			expect(result2).toBe(expectedResult2);
		});
		test('Should throw error for minus value', () => {
			const num1 = '-1';
			const num2 = -1;

			const resultFn1 = () => verb.toVerbalNotation(num1);
			const resultFn2 = () => verb.toVerbalNotation(num2);

			expect(resultFn1).toThrow();
			expect(resultFn2).toThrow();
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

	describe('Sanitization of passed parameter', () => {
		test('Should pass number as parameter', () => {
			const num = 654894;

			const result = verb.toVerbalNotation(num);

			const expectedResult =
				'six hundred fifty four thousand eight hundred ninety four 00/100 $';
			expect(result).toBe(expectedResult);
		});
		test('Should remove zeros if they are at the beginning of the string', () => {
			const input = '00005';

			const result = verb.toVerbalNotation(input);

			const expectedResult = 'five 00/100 $';
			expect(result).toBe(expectedResult);
		});
		test('Should accept a number as a parameter if the digits are separated by spaces', () => {
			const input = '1 000';

			const result = verb.toVerbalNotation(input);

			const expectedResult = 'one thousand 00/100 $';
			expect(result).toBe(expectedResult);
		});
		test('Should accept a parameter if there are letters behind the numbers', () => {
			const input = '1 USD';

			const result = verb.toVerbalNotation(input);

			const expectedResult = 'one 00/100 $';
			expect(result).toBe(expectedResult);
		});
		test('Should throw an error if the letters are between numbers', () => {
			const input = '11s555';

			const resultFn = () => verb.toVerbalNotation(input);

			expect(resultFn).toThrow();
		});
	});
});
