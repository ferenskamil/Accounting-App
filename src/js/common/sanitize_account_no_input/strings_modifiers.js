export function sanitizeAccountNo(accountNo) {
	accountNo = cleanNumberString(accountNo);
	accountNo = accountNo.substring(0, 26);
	accountNo = insertSpacesIntoString(accountNo, 2, 4);
	return accountNo;
}

export function insertSpacesIntoString(string, firstSplit, eachNextSplit) {
	// validation
	if (typeof string !== 'string') {
		throw new Error('"string" param must be a string');
		console.error('Invalid param:', error.message);
	} else if (
		typeof firstSplit !== 'number' ||
		firstSplit % 1 !== 0 ||
		firstSplit < 0
	) {
		throw new Error('"firstSplit" param must be integer');
		console.error('Invalid param:', error.message);
	} else if (typeof eachNextSplit !== 'number' || eachNextSplit % 1 !== 0) {
		throw new Error('"eachNextSplit" param must be integer');
		console.error('Invalid param:', error.message);
	}

	// logic
	const parts = [];
	parts.push(string.substring(0, firstSplit));
	string = string.substring(firstSplit);

	do {
		parts.push(string.substring(0, eachNextSplit));
		string = string.slice(eachNextSplit);
	} while (string.length > 0);

	return parts.join('') !== '' ? parts.join(' ') : parts.join('');
}

export function cleanNumberString(string) {
	return string.replace(/[^0-9]/g, '');
}
