console.log('Test');

const unities = [
	'zero',
	'jeden',
	'dwa',
	'trzy',
	'cztery',
	'pięć',
	'sześć',
	'siedem',
	'osiem',
	'dziewięć',
];

const dozens = [
	'dziesięć',
	'dwadzieścia',
	'trzydzieści',
	'czterdzieści',
	'pięćdziesiąt',
	'sześćdziesiąt',
	'siedemdziesiąt',
	'osiemdziesiąt',
	'dziewięćdziesiąt',
];

const hundreds = [
	'sto',
	'dwieście',
	'trzysta',
	'czterysta',
	'pięćset',
	'sześćset',
	'siedemset',
	'osiemset',
	'dziewięćset',
];

const thousands_1 = 'tysiąc';
const thousands_234 = 'tysiące';
const thousands_rest = 'tysięcy';

const numToWord = (num) => {
	// loop that removes zeros from the front of the number (string)
	while (num[0] === '0') {
		num = num.substring(1);
	}

	let restAmount = '00';
	if (num.includes(',')) {
		restAmount = num.substring(num.indexOf(',') + 1);
		// In the future, the notation can be mathematically rounded instead of shortened
		restAmount = restAmount.substring(0, 2);
	}

	let wholeAmount;
	if (num.includes(',')) {
		wholeAmount = num.substring(0, num.indexOf(','));
	}

	if (wholeAmount.length === 0) {
		console.log('Podaj jakąś liczbę, podana liczba jest za krótka');
	}

	if (wholeAmount.length === 1) {
		unitiesNumToWords(wholeAmount);
	} else if (wholeAmount.length === 2) {
		dozensNumToWords(wholeAmount);
	} else if (wholeAmount.length === 3) {
		hundredsNumToWords(wholeAmount);
	} else if (wholeAmount.length === 4) {
		thousandsNumToWords(wholeAmount);
	} else if (wholeAmount.length === 5) {
		aboveOntenThousandsToWords(wholeAmount);
	} else if (wholeAmount.length === 6) {
		aboveHundredThousandsNumToWords(wholeAmount);
	} else {
		console.log('Podana liczba jest za długa - prace trwają.');
	}

	// return - To co zwracamy wyświetli się na ekranie
};

const unitiesNumToWords = (num) => {
	console.log('Liczba składa się z jedności');
};

const dozensNumToWords = (num) => {
	console.log('Liczba składa się z dziesiątek');
};

const hundredsNumToWords = (num) => {
	console.log('Liczba składa się z setek');
};

const thousandsNumToWords = (num) => {
	console.log('Liczba składa się z tysięcy');
};

const aboveOntenThousandsToWords = (num) => {
	console.log('Liczba składa się z nastu tysięcy');
};

const aboveHundredThousandsNumToWords = (num) => {
	console.log('Liczba składa się z ponad stu tysięcy');
};

numToWord('000000945467,968745');

// http://localhost:3000/invoice.html
