export class VerbalNotation {
	constructor() {
		this.unities = {
			0: 'zero',
			1: 'one',
			2: 'two',
			3: 'three',
			4: 'four',
			5: 'five',
			6: 'six',
			7: 'seven',
			8: 'eight',
			9: 'nine',
		};

		this.dozens = {
			2: 'twenty ',
			3: 'thirty ',
			4: 'forty ',
			5: 'fifty ',
			6: 'sixty ',
			7: 'seventy ',
			8: 'eighty ',
			9: 'ninety ',
		};

		this.hundreds = {
			1: 'one hundred ',
			2: 'two hundred ',
			3: 'three hundred ',
			4: 'four hundred ',
			5: 'five hundred ',
			6: 'six hundred ',
			7: 'seven hundred ',
			8: 'eight hundred ',
			9: 'nine hundred ',
		};

		this.aboveTen = {
			10: 'ten',
			11: 'eleven',
			12: 'twelve',
			13: 'thirteen',
			14: 'fourteen',
			15: 'fifteen',
			16: 'sixteen',
			17: 'seventeen',
			18: 'eighteen',
			19: 'nineteen',
		};

		this.thousands_ends = {
			0: 'thousand',
			1: 'thousand',
			2: 'thousand',
			3: 'thousand',
			4: 'thousand',
			5: 'thousand',
			6: 'thousand',
			7: 'thousand',
			8: 'thousand',
			9: 'thousand',
		};
	}

	verbalNotation(num) {
		// num = num.toString();
		// const threeDigitsPartsArr = [];
		// const currency = '$';
		// let rest = '00';
		// let whole = (num - (num % 1)).toString();
		// let workNum = whole;

		// while (num[0] === '0') {
		// 	num = num.substring(1);
		// }

		// if (num.includes('.')) {
		// 	rest = num.substring(num.indexOf('.') + 1);
		// 	rest = rest.concat('0');
		// 	rest = rest.substring(0, 2);
		// 	whole = num.substring(0, num.indexOf('.'));
		// }

		// while (workNum.length >= 3) {
		// 	threeDigitsPartsArr.unshift(workNum.slice(-3));
		// 	workNum = workNum.slice(0, -3);
		// }

		// if (workNum.length < 3 && workNum) {
		// 	threeDigitsPartsArr.unshift(workNum);
		// }

		// if (whole.length <= 3) {
		// 	return `${this.verbalNotationOfThreeDigitNumber(
		// 		threeDigitsPartsArr[0]
		// 	)} ${rest}/100 ${currency}`;
		// } else if (whole.length <= 6) {
		// 	let thousandsForm = threeDigitsPartsArr[0].slice(-1);

		// 	return `${this.verbalNotationOfThreeDigitNumber(
		// 		threeDigitsPartsArr[0]
		// 	)} ${
		// 		this.thousands_ends[`${thousandsForm}`]
		// 	} ${this.verbalNotationOfThreeDigitNumber(
		// 		threeDigitsPartsArr[1]
		// 	)} ${rest}/100 ${currency}`;
		// }

		// return 'The number is too long';
	}

	verbalNotationOfThreeDigitNumber(num) {
		// Validation
		if (num < 0 || num > 999 || num % 1 !== 0)
			throw new Error('Invalid number.');

		// Variables
		const numArr = num.split('');
		const unit = numArr.pop();
		const dozen = numArr.pop();
		const hundred = numArr.pop();

		// Stwórz zmienną, która będzie modyfikowana
		let result = '';

		// Jeżeli znaleziono liczbę setek
		result += hundred ? this.hundreds[`${hundred}`] : '';

		// Jeżeli znaleziono liczbę dziesiątek i jest ona > 1
		result +=
			dozen > 1 ? this.dozens[`${dozen}`] + this.unities[`${unit}`] : '';

		// Jeżeli znaleziono liczbę dziesiątek i jest ona równa === 1
		result += dozen === 1 ? this.aboveTen[`${dozen}${unit}`] : '';

		// Jeżeli nie znalezino liczbę dziesiątek to dopisz liczbę jedności
		result += dozen === 0 || !dozen ? this.unities[`${unit}`] : '';

		// Zwróć uzyskany wynik
		return result;
	}
}
