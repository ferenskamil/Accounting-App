import { it, expect, describe } from 'vitest';
import {
	sanitizeAccountNo,
	insertSpacesIntoString,
	cleanNumberString,
} from './strings_modifiers.js';
import { checkSpacePositions } from '../../utils/check_space_positions.js';

describe('insertSpacesIntoString()', () => {
	it('should thrown error if type of "string" parameter not be a string', () => {
		const input1 = 5;
		const input2 = [];
		const input3 = {};
		const input4 = undefined;
		const input5 = true;
		const commonFirstSplit = 2;
		const commonEachNextSplit = 4;

		const resultFn1 = () =>
			insertSpacesIntoString(
				input1,
				commonFirstSplit,
				commonEachNextSplit
			);
		const resultFn2 = () =>
			insertSpacesIntoString(
				input2,
				commonFirstSplit,
				commonEachNextSplit
			);
		const resultFn3 = () =>
			insertSpacesIntoString(
				input3,
				commonFirstSplit,
				commonEachNextSplit
			);
		const resultFn4 = () =>
			insertSpacesIntoString(
				input4,
				commonFirstSplit,
				commonEachNextSplit
			);
		const resultFn5 = () =>
			insertSpacesIntoString(
				input5,
				commonFirstSplit,
				commonEachNextSplit
			);

		expect(resultFn1).toThrow();
		expect(resultFn2).toThrow();
		expect(resultFn3).toThrow();
		expect(resultFn4).toThrow();
		expect(resultFn5).toThrow();
	});

	it('should thrown error if type of "firstSplit" parameter not be a number', () => {
		const commonString = 'lorem ipsum dolor es';
		const firstSplit1 = '5';
		const firstSplit2 = [];
		const firstSplit3 = {};
		const firstSplit4 = undefined;
		const firstSplit5 = true;
		const commonEachNextSplit = 4;

		const resultFn1 = () =>
			insertSpacesIntoString(
				commonString,
				firstSplit1,
				commonEachNextSplit
			);
		const resultFn2 = () =>
			insertSpacesIntoString(
				commonString,
				firstSplit2,
				commonEachNextSplit
			);
		const resultFn3 = () =>
			insertSpacesIntoString(
				commonString,
				firstSplit3,
				commonEachNextSplit
			);
		const resultFn4 = () =>
			insertSpacesIntoString(
				commonString,
				firstSplit4,
				commonEachNextSplit
			);
		const resultFn5 = () =>
			insertSpacesIntoString(
				commonString,
				firstSplit5,
				commonEachNextSplit
			);

		expect(resultFn1).toThrow();
		expect(resultFn2).toThrow();
		expect(resultFn3).toThrow();
		expect(resultFn4).toThrow();
		expect(resultFn5).toThrow();
	});

	it('should thrown error if type of "eachNextSplit" parameter not be a number', () => {
		const commonString = 'lorem ipsum dolor es';
		const commonFirstSplit = 2;
		const eachNextSplit1 = '4';
		const eachNextSplit2 = [];
		const eachNextSplit3 = {};
		const eachNextSplit4 = undefined;
		const eachNextSplit5 = true;

		const resultFn1 = () =>
			insertSpacesIntoString(
				commonString,
				commonFirstSplit,
				eachNextSplit1
			);
		const resultFn2 = () =>
			insertSpacesIntoString(
				commonString,
				commonFirstSplit,
				eachNextSplit2
			);
		const resultFn3 = () =>
			insertSpacesIntoString(
				commonString,
				commonFirstSplit,
				eachNextSplit3
			);
		const resultFn4 = () =>
			insertSpacesIntoString(
				commonString,
				commonFirstSplit,
				eachNextSplit4
			);
		const resultFn5 = () =>
			insertSpacesIntoString(
				commonString,
				commonFirstSplit,
				eachNextSplit5
			);

		expect(resultFn1).toThrow();
		expect(resultFn2).toThrow();
		expect(resultFn3).toThrow();
		expect(resultFn4).toThrow();
		expect(resultFn5).toThrow();
	});

	it('should thrown error if "firstSplit" parameter < 0', () => {
		const string = 'loremipsum';
		const firstSplit = -1;
		const eachNextSplit = 2;

		const resultFn = () =>
			insertSpacesIntoString(string, firstSplit, eachNextSplit);

		expect(resultFn).toThrow();
	});

	it('should not thrown error if "firstSplit" parameter = 0', () => {
		const string = 'loremipsum';
		const firstSplit = 0;
		const eachNextSplit = 2;

		const resultFn = () =>
			insertSpacesIntoString(string, firstSplit, eachNextSplit);

		expect(resultFn).not.toThrow();
	});

	it('should thrown error if "eachNextSplit" parameter < 1', () => {
		const string = 'loremipsum';
		const firstSplit = 1;
		const eachNextSplit = 0;

		const resultFn = () =>
			insertSpacesIntoString(string, firstSplit, eachNextSplit);

		expect(resultFn).toThrow();
	});

	it('should not thrown error if "eachNextSplit" parameter = 1', () => {
		const string = 'loremipsum';
		const firstSplit = 1;
		const eachNextSplit = 1;

		const resultFn = () =>
			insertSpacesIntoString(string, firstSplit, eachNextSplit);

		expect(resultFn).not.toThrow();
	});

	it('should thrown error if "firstSplit" param not be integer', () => {
		const string = 'loremipsum';
		const firstSplit = 1.1;
		const eachNextSplit = 2;

		const resultFn = () =>
			insertSpacesIntoString(string, firstSplit, eachNextSplit);

		expect(resultFn).toThrow();
	});

	it('should thrown error if "eachNextSplit" param not be integer', () => {
		const string = 'loremipsum';
		const firstSplit = 1;
		const eachNextSplit = 2.5;

		const resultFn = () =>
			insertSpacesIntoString(string, firstSplit, eachNextSplit);

		expect(resultFn).toThrow();
	});

	it('should yield empty string if empty string will be provided as "string" param', () => {
		const string = '';
		const firstSplit = 2;
		const eachNextSplit = 4;

		const result = insertSpacesIntoString(
			string,
			firstSplit,
			eachNextSplit
		);

		const expectedResult = '';
		expect(result).toBe(expectedResult);
	});

	it('location of the first space in the returned string should depend on the "firstSplit" parameter', () => {
		const commonString = 'loremipsumdolores';
		const firstSplit = 2;
		const commonEachNextSplit = 4;

		const result = insertSpacesIntoString(
			commonString,
			firstSplit,
			commonEachNextSplit
		);

		const spacePos = result.indexOf(' ');
		expect(spacePos).toBe(firstSplit);
	});

	it('location of the consecuitive spaces in the returned string should depend on the "eachNextSplit" parameter', () => {
		const commonString = 'loremipsumdolores';
		const commonFirstSplit = 2;
		const eachNextSplit = 4;

		const result = insertSpacesIntoString(
			commonString,
			commonFirstSplit,
			eachNextSplit
		);

		const expectedPositions = [2, 7, 12, 17];
		const spacePositions = checkSpacePositions(result);
		expect(expectedPositions).toStrictEqual(spacePositions);
	});
});

describe('cleanNumberString()', () => {
	test('should throw an error for parameters other than string', () => {
		const inputs = [1, [], {}, undefined, true];

		inputs.forEach((el) => {
			const resultFn = () => cleanNumberString(el);
			expect(resultFn).toThrow();
		});
	});

	test('should not throw an error for string', () => {
		const input = 'lorem';
		const resultFn = () => cleanNumberString(input);
		expect(resultFn).not.toThrow();
	});

	test('should clean string from letters', () => {
		const input = 'aaa5aaa';
		const result = cleanNumberString(input);

		const expectedResult = '5';
		expect(result).toBe(expectedResult);
	});

	test('should clean string from whitespaces', () => {
		const input = '  12 345 67 89   ';
		const result = cleanNumberString(input);

		const expectedResult = '123456789';
		expect(result).toBe(expectedResult);
	});

	test('should clean string from special characters', () => {
		const input = '~`!@#$%^&*()-_=+{}[]|/:;<>,.?' + "'" + `\\`;
		const result = cleanNumberString(input);

		const expectedResult = '';
		expect(result).toBe(expectedResult);
	});

	test('should output be a string', () => {
		const input = '123456789';
		const result = cleanNumberString(input);

		expect(result).toBeTypeOf('string');
	});

	test('should output contains only digits for length > 0', () => {
		const input = '123456789';
		const result = cleanNumberString(input);

		const parsedResult = parseInt(result);
		const revertedToStringResult = parsedResult.toString();
		expect(result).toBe(revertedToStringResult);
	});
});

describe('sanitizeAccountNo()', () => {
	// Account number format : "11 2222 3333 4444 5555 6666 7777" (26 digits)

	test('should return string of 26 digits consistent with the bank account number format for 26 digits number string', () => {
		const numberString = '11222233334444555566667777';
		const accountNo = sanitizeAccountNo(numberString);

		const expectedAccountNo = '11 2222 3333 4444 5555 6666 7777';
		expect(accountNo).toBe(expectedAccountNo);
	});

	test('should return string of <26 digits consistent with the bank account number format for <26 numberstring ', () => {
		const numberString = '112222333344445555666';
		const accountNo = sanitizeAccountNo(numberString);

		const expectedAccountNo = '11 2222 3333 4444 5555 666';
		expect(accountNo).toBe(expectedAccountNo);
	});

	test('should return string of 26 digits consistent with the bank account number format for >26 numberstring ', () => {
		const numberString = '112222333344445555666677778888';
		const accountNo = sanitizeAccountNo(numberString);

		const expectedAccountNo = '11 2222 3333 4444 5555 6666 7777';
		expect(accountNo).toBe(expectedAccountNo);
	});
});
