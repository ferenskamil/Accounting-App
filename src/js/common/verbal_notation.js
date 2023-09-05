export class VerbalNotation {
	// class VerbalNotation {
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
			2: 'twenty',
			3: 'thirty',
			4: 'forty',
			5: 'fifty',
			6: 'sixty',
			7: 'seventy',
			8: 'eighty',
			9: 'ninety',
		};

		this.hundreds = {
			1: 'one hundred',
			2: 'two hundred',
			3: 'three hundred',
			4: 'four hundred',
			5: 'five hundred',
			6: 'six hundred',
			7: 'seven hundred',
			8: 'eight hundred',
			9: 'nine hundred',
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

		this.thousandsVariety = {
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

	toVerbalNotation(num) {
		// initial validation
		this.validateType(num);

		// sanitization
		const cleanNumStr = this.sanitizeNumberString(num);

		// extract value to a whole number and tenths
		const whole = this.getWholeNumber(cleanNumStr);
		const tenths = this.getTenths(cleanNumStr);

		// Divide number to parts of 3 digits
		let parts = this.divideStringToParts(whole, 3);

		// zamień każdą część na notację słowną
		parts.forEach((el) => {
			el = this.verbalNotationOfThreeDigitNumber(parseInt(el));
		});

		// Połącz w 'verbalnotację dodając w opowiednich miejscach
		const verbalNotation = this.concatPartsToVerbalNotation(parts);

		// Create remineder (f.e. '10/100 $')
		const remainder = `${tenths}/100 $`;

		// Return verbal notation of number
		const result = verbalNotation + ' ' + remainder;
		return result.replaceAll('  ', ' ');
	}

	validateType(num) {
		if (isNaN(num)) throw new Error('wrong type of parameter (NaN)');
		if (typeof num !== 'string' && typeof num !== 'number')
			throw new Error(`wrong type of parameter (${typeof num})`);
	}

	sanitizeNumberString(num) {
		// Convert number to string
		if (typeof num === 'number') num = num.toString();

		// Remain only digits, dots, commas
		num = num.replace(/[^0-9.,]/g, '');

		// Replace commas to dots
		num = num.replaceAll(',', '.');

		// Remove the second dot and every character after it
		num = parseFloat(num).toString();

		// Remove redundant zeros
		while (
			num.startsWith('0') &&
			!num.startsWith('0.') &&
			!num.startsWith('0,') &&
			num !== '0'
		) {
			num = num.slice(1);
		}

		// Return sanitized num
		return num;
	}

	getWholeNumber(num) {
		return parseInt(num).toString();
	}

	getTenths(num) {
		if (typeof num === 'string') num = parseFloat(num);
		const roundedNum = this.roundDecimals(num);
		const stringNum = roundedNum.toFixed(2);
		const dotIdx = stringNum.indexOf('.');
		const tenths = stringNum.substring(dotIdx + 1);
		return tenths;
	}

	divideStringToParts(string, partLength) {
		const resultArr = [];

		while (string.length >= partLength) {
			resultArr.unshift(string.slice(-partLength));
			string = string.slice(0, -partLength);
		}
		if (string.length < partLength && string) {
			resultArr.unshift(string);
		}
		return resultArr;
	}

	concatPartsToVerbalNotation(array) {
		// Zamień na liczby
		array.forEach((el) => (el = parseInt(el)));

		// result
		let result = '';

		// Verbal notation for numbers 0 - 999
		const mniejsze = array.pop();
		const below1000 = this.verbalNotationOfThreeDigitNumber(mniejsze);

		// Verbal notation for numbers 1000 - 999999
		let above1000 = '';
		if (array[0]) {
			const wieksze = array.pop();
			above1000 = this.verbalNotationOfThreeDigitNumber(wieksze);

			// Variation of the word thousand
			const thousandVariation = 'thousand';
			above1000 += ' ' + thousandVariation + ' ';
		}
		return above1000 + below1000;
	}

	verbalNotationOfThreeDigitNumber(num) {
		// Validation
		if (num < 0 || num > 999 || num % 1 !== 0)
			// throw new Error('Invalid number.');

			// Variables
			num = num.toString();
		const numArr = num.toString().split('');
		const unit = parseInt(numArr.pop());
		const dozen = parseInt(numArr.pop());
		const hundred = parseInt(numArr.pop());

		// Stwórz zmienną, która będzie modyfikowana
		let result = '';

		// Jeżeli znaleziono liczbę setek
		result += hundred ? this.hundreds[`${hundred}`] + ' ' : '';

		// Jeżeli znaleziono liczbę dziesiątek i jest ona > 1
		result +=
			dozen > 1
				? this.dozens[`${dozen}`] + ' ' + this.unities[`${unit}`]
				: '';

		// Jeżeli znaleziono liczbę dziesiątek i jest ona równa === 1
		result += dozen === 1 ? this.aboveTen[`${dozen}${unit}`] : '';

		// Jeżeli nie znalezino liczbę dziesiątek to dopisz liczbę jedności
		if ((dozen === 0 || !dozen) && unit !== 0) {
			result = this.unities[`${unit}`];
		}

		//
		if (num === '0') result = this.unities[`${unit}`];

		// Zwróć uzyskany wynik
		result = result.replaceAll('  ', ' ');
		return result;
	}

	getNumberOfDecimalDigits(num) {
		// if (num % 1) {
		// 	return 0;
		// }

		/// refactor nazw i testy i warunki brzegowe
		num = num.toString();
		const dotIdx = num.indexOf('.');
		num = num.substring(dotIdx + 1);
		return num.length;
	}

	roundDecimals(num) {
		/// działa ale potrzebuje refaktoryzacji i testów
		console.log(num);
		// Zakładamy że liczba jest stringiem i ma rozwinięcie dziesiętne

		const strNum = num.toString();
		let numberOfDecimalDigits = this.getNumberOfDecimalDigits(num);
		console.log(numberOfDecimalDigits);
		if (numberOfDecimalDigits > 2) {
			do {
				const strNum = num.toString();
				const lastDecimalDigit = strNum.at(-1);
				const beforeRound = parseFloat(`0.${lastDecimalDigit}`);
				const roundedLastDecimal = Math.round(beforeRound); //1

				let numberTwoFromTheEnd = parseInt(strNum.at(-2));
				console.log(numberTwoFromTheEnd);
				if (roundedLastDecimal === 1) numberTwoFromTheEnd++;
				console.log(numberTwoFromTheEnd);

				// sklejanie
				const roundedNumStr =
					strNum.substring(0, strNum.length - 2) +
					numberTwoFromTheEnd; //roundednumbertwofromtheend
				console.log(roundedNumStr);
				const roundedNum = parseFloat(roundedNumStr);
				console.log(roundedNum + 'test');

				// console.log(roundedLastDecimal);

				// numberOfDecimalDigits = getNumberOfDecimalDigits(num);
				num = roundedNum;

				numberOfDecimalDigits = this.getNumberOfDecimalDigits(num);
			} while (numberOfDecimalDigits > 2);
		}

		return num;
	}
}

// const fn = new VerbalNotation();

// // const result = fn.concatPartsToVerbalNotation(['10', '111']);
// const result = fn.toVerbalNotation(100);
// // const result2 = fn.verbalNotationOfThreeDigitNumber(999);
