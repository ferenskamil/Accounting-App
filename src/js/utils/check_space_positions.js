export function checkSpacePositions(string) {
	const spacePositions = [];
	for (let i = 0; i < string.length; i++) {
		if (string[i] === ' ') {
			spacePositions.push(i);
		}
	}
	return spacePositions;
}
