const amountNumSpan = document.querySelector('.invoice__sum-num').textContent;
const amountWordSpan = document.querySelector('.invoice__sum-word');

const unities = {
	1: 'jeden',
	2: 'dwa',
	3: 'trzy',
	4: 'cztery',
	5: 'pięć',
	6: 'sześć',
	7: 'siedem',
	8: 'osiem',
	9: 'dziewięć',
};

const aboveTen = {
	10: 'dziesięć',
	11: 'jedenaście',
	12: 'dwanaście',
	13: 'trzynaście',
	14: 'czternaście',
	15: 'pietnaście',
	16: 'szesnaście',
	17: 'siedemnaście',
	18: 'osiemnaście',
	19: 'dziewiętnaście',
};

const dozens = {
	2: 'dwadzieścia ',
	3: 'trzydzieści ',
	4: 'czterdzieści ',
	5: 'pięćdziesiąt ',
	6: 'sześćdziesiąt ',
	7: 'siedemdziesiąt ',
	8: 'osiemdziesiąt ',
	9: 'dziewięćdziesiąt ',
};

const hundreds = {
	1: 'sto ',
	2: 'dwieście ',
	3: 'trzysta ',
	4: 'czterysta ',
	5: 'pięćset ',
	6: 'sześćset ',
	7: 'siedemset ',
	8: 'osiemset ',
	9: 'dziewięćset ',
};

const thousands_ends = {
	0: 'tysięcy',
	1: 'tysiąc',
	2: 'tysiące',
	3: 'tysiące',
	4: 'tysiące',
	5: 'tysięcy',
	6: 'tysięcy',
	7: 'tysięcy',
	8: 'tysięcy',
	9: 'tysięcy',
};

const threeDigitsToPhrase = (num) => {
	const numArr = num.split('');
	const unit = numArr.pop();
	const dozen = numArr.pop();
	const hundred = numArr.pop();

	let result = '';

	if (hundred) {
		result = ''.concat(hundreds[`${hundred}`], result);
	}

	if (dozen && dozen > '1') {
		result = ''.concat(result, dozens[`${dozen}`]);
		result = ''.concat(result, unities[`${unit}`]);
	} else if (dozen && dozen === '1') {
		result = ''.concat(result, aboveTen[`${dozen}${unit}`]);
	}

	if (!dozen && unit) {
		result = ''.concat(unities[`${unit}`], result);
	}

	return result;
};

const changeNum = (num) => {
	console.log(num);
	const threeDigitsArr = [];
	const currency = 'zł';
	let workNum = num;
	let restAmount = '00';
	let wholeAmount;

	// loop that removes zeros from the front of the number (string)
	while (num[0] === '0') {
		num = num.substring(1);
	}

	if (num.includes(',')) {
		restAmount = num.substring(num.indexOf(',') + 1);
		restAmount = restAmount.substring(0, 2);
		wholeAmount = num.substring(0, num.indexOf(','));
	}

	while (workNum.length >= 3) {
		threeDigitsArr.unshift(workNum.slice(-3));
		workNum = workNum.slice(0, -3);
	}

	if (workNum.length < 3 && workNum) {
		threeDigitsArr.unshift(workNum);
	}

	if (wholeAmount.length <= 3) {
		return (amountWordSpan.textContent = `${threeDigitsToPhrase(
			threeDigitsArr[0]
		)} ${restAmount}/100 ${currency}`);
	} else if (wholeAmount.length <= 6) {
		let thousandsForm = threeDigitsArr[0].slice(-1);

		return (amountWordSpan.textContent = `${threeDigitsToPhrase(
			threeDigitsArr[0]
		)} ${thousands_ends[`${thousandsForm}`]} ${threeDigitsToPhrase(
			threeDigitsArr[1]
		)} ${restAmount}/100 ${currency}`);
	}

	return (amountWordSpan.textContent = 'Za długa liczba');
};

changeNum(amountNumSpan);
