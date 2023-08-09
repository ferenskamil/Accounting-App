// ============================================================
// GLOBAL FUNCTIONS

/* 
changeValueInHiddenInput(valueString, inputIdString)
This function completes the value in the indicated inpute.
In this application, the value from the hidden inputs will later 
be passed via POST method to the PHP script.
*/
const changeValueInHiddenInput = (valueString, inputIdString) => {
	const input = document.querySelector(inputIdString);
	input.value = valueString;
};

/* 
parseAmountToCount(value)
This function takes an amount (sring) and converts it to a number.
E.g.. 
'12.99 PLN' >>> 12.99
'15 PLN' >>> 15
*/
const parseAmountToCount = (value) => {
	// if string convert to number
	if (typeof value === 'string') {
		value = value.replace(',', '.');
		value = parseFloat(value);
	}

	// round to two decimal places
	if (value % 1 === 0) {
		value = value.toFixed(2); // changes to string
		value = parseFloat(value);
	}

	return value;
};

/*
convertNumtoAmount(number, string)
This function takes a number, rounds it to two decimal places, 
adds a currency notation and converts the period to a comma
*/
const convertNumtoAmount = (num, currencyString) => {
	num = num.toFixed(2);
	num += ' ' + currencyString;
	num = num.replace('.', ',');

	return num;
};

// ============================================================
// UPDATE DATA IN SERVICE TABLE
const updateServicesTable = () => {
	updateItemsNumbers();
	showEmptyInfo();
	calculateTableSummary();
};

const updateItemsNumbers = () => {
	const itemsNoSpans = document.querySelectorAll(
		'.invoice-edit__form-box-services-table .service-item-number'
	);

	const positionHiddenInputs = document.querySelectorAll(
		'.position-hidden-input'
	);

	for (let i = 0; i < itemsNoSpans.length; i++) {
		itemsNoSpans[i].textContent = i + 1;
	}

	for (let i = 0; i < positionHiddenInputs.length; i++) {
		positionHiddenInputs[i].value = i + 1;
	}
};

const showEmptyInfo = () => {
	const services = document.querySelectorAll('#services-table tbody tr');
	const emptyInfo = document.querySelector('#services-table tbody .empty-info');
	emptyInfo.style.display = services.length === 1 ? 'grid' : 'none';
};

const calculateTableSummary = () => {
	sumUpValues('.service-item-net-sum', '.invoice-total-net');
	sumUpValues('.service-item-gross-sum', '.invoice-total-gross');
};

const sumUpValues = (inputsArrSelectorAll, outputSpanSelector) => {
	const inputsArr = document.querySelectorAll(inputsArrSelectorAll);
	const outputSpan = document.querySelector(outputSpanSelector);

	let sum = 0;
	inputsArr.forEach((el) => {
		sum += parseFloat(el.value.replace(',', '.'));
	});

	outputSpan.textContent = `${sum.toFixed(2)} PLN`.replace('.', ',');
	updateAllHiddenInputValues();
};

const updateAllHiddenInputValues = () => {
	const totalGross = document.querySelector('.invoice-total-gross');
	const totalGrossNum = parseAmountToCount(totalGross.textContent);

	const totalNet = document.querySelector('.invoice-total-net');
	const totalNetNum = parseAmountToCount(totalNet.textContent);

	changeValueInHiddenInput(totalGrossNum, '#total-gross');
	changeValueInHiddenInput(totalGrossNum, '#to-pay-numeric');
	changeValueInHiddenInput(verbalNotation(totalGrossNum), '#to-pay-verbal');
	changeValueInHiddenInput(totalNetNum, '#total-net');
};

document.addEventListener('DOMContentLoaded', updateServicesTable);

// ============================================================
// ADD NEW SERVICE TR IN TABLE
const addNewServiceBtn = document.querySelector('.new-service-btn');

const createNewService = (e) => {
	e.preventDefault();

	const servicesTbody = document.querySelector('#services-table tbody');
	const servicesLength = servicesTbody.querySelectorAll('tr').length;

	const newItem = document.createElement('tr');
	const itemNoSpan = document.createElement('td');
	itemNoSpan.innerHTML = `<span class="service-title--mobile">No.: </span><span class="service-item-number"></span>
<input hidden class="position-hidden-input" type="text" name="position[${servicesLength}]" value=""></input>`;

	const serviceName = document.createElement('td');
	serviceName.innerHTML = `<span class="service-title--mobile">Item / service: </span>
<input class="service-item-name"  type="text" name="service_name[${servicesLength}]">`;

	const activityCode = document.createElement('td');
	activityCode.innerHTML = `<span class="service-title--mobile">Service code: </span>
<input class="service-item-code" type="text" name="service_code[${servicesLength}]">`;

	const amount = document.createElement('td');
	amount.innerHTML = `<span class="service-title--mobile">Quantity: </span>
<input type="number" value="1" min="0" class="service-item-amount" name="quantity[${servicesLength}]">`;

	const netValue = document.createElement('td');
	netValue.innerHTML = `<span class="service-title--mobile">Net price (PLN): </span>
<input type="number" min="0" value="0.00" class="service-item-net-value" name="item_net_price[${servicesLength}]" step=".01">`;

	const taxValue = document.createElement('td');
	taxValue.innerHTML = `<span class="service-title--mobile">Tax: </span>
<select class="service-item-tax" name="service_tax[${servicesLength}]">
	<option value="0">tax-free</option>
	<option value="0.08">8%</option>
	<option value="0.23">23%</option>
</select>`;

	const netSum = document.createElement('td');
	netSum.innerHTML = `<span class="service-title--mobile">Net sum (PLN): </span>
<input type="text" value="0.00 PLN" class="service-item-net-sum" name="service_total_net[${servicesLength}]" readonly>`;

	const grossSum = document.createElement('td');
	grossSum.innerHTML = `<span class="service-title--mobile">Gross sum (PLN): </span>
<input type="text" value="0.00 PLN" class="service-item-gross-sum" name="service_total_gross[${servicesLength}]" readonly>`;

	const deleteBtn = document.createElement('td');
	deleteBtn.innerHTML = `<button class="delete-btn">
<i class="fa-solid fa-trash"></i>Delete</button>`;

	newItem.append(
		itemNoSpan,
		serviceName,
		activityCode,
		amount,
		netValue,
		taxValue,
		netSum,
		grossSum,
		deleteBtn
	);
	servicesTbody.append(newItem);

	updateServicesTable();
};

addNewServiceBtn.addEventListener('click', (e) => createNewService(e));

// ============================================================
// UPDATE VALUES IN SERVICE TR AFTER CHANGES IN INPUT
const updateServiceTr = (serviceTr) => {
	const quantity = serviceTr.querySelector('.service-item-amount').value;
	const netPerOnePiece = serviceTr.querySelector(
		'.service-item-net-value'
	).value;
	const tax = serviceTr.querySelector('.service-item-tax').value;
	const net = serviceTr.querySelector('.service-item-net-sum');
	const gross = serviceTr.querySelector('.service-item-gross-sum');

	// Calculate total net for one serviceTr
	net.value = convertNumtoAmount(quantity * netPerOnePiece, 'PLN');

	// Calculate total gross for one serviceTr
	const totalGross =
		parseAmountToCount(tax) * parseAmountToCount(net.value) +
		parseAmountToCount(net.value);

	gross.value = convertNumtoAmount(totalGross, 'PLN');

	// Sum up the table
	calculateTableSummary();
};

document.addEventListener('input', (e) => {
	if (
		e.target.classList.contains('service-item-amount') ||
		e.target.classList.contains('service-item-net-value') ||
		e.target.classList.contains('service-item-tax')
	) {
		updateServiceTr(e.target.parentElement.parentElement);
	}
});

// ============================================================
// DELETE SERVICE TR FROM TABLE
const deleteServiceItem = (serviceTr) => {
	serviceTr.outerHTML = '';
	updateServicesTable();
};

document.addEventListener('click', (e) => {
	if (e.target.classList.contains('delete-btn')) {
		deleteServiceItem(e.target.parentElement.parentElement);
	}
});

// ============================================================
// BLOCK THE FORM BEING SENT AUTOMATICALLY AFTER PRESS ENTER IN TEXTAREA
document.addEventListener('keydown', (e) => {
	if (e.key === 'Enter' && e.target.localName !== 'textarea') {
		e.preventDefault();
	}
});