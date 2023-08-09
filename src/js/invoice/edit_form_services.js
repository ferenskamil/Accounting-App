// ============================================================
// DISPLAY INFO WHEN TBODY IS EMPTY

const servicesTbody = document.querySelector(
	'.invoice-edit__form-box-services-table tbody'
);
const addNewServiceBtn = document.querySelector('.new-service-btn');

const showEmptyInfo = () => {
	const services = servicesTbody.querySelectorAll('tr');
	const emptyInfo = servicesTbody.querySelector('.empty-info');
	emptyInfo.style.display = services.length === 1 ? 'grid' : 'none';
};

document.addEventListener('DOMContentLoaded', showEmptyInfo);

// ============================================================
// ADD SERVICE AFTER CLICK THE"ADD" BUTTON

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

let servicesLength = servicesTbody.querySelectorAll('tr').length;
const createNewService = (e) => {
	e.preventDefault();

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

	updateItemsNumbers();
	showEmptyInfo();

	servicesLength++;
};

addNewServiceBtn.addEventListener('click', (e) => createNewService(e));

// ============================================================
// CALCULATE VALUES IN SERVICE ITEM

const calculateItemTotalNet = (serviceTr) => {
	const amount = serviceTr.querySelector('.service-item-amount').value;
	const netPerOnePiece = serviceTr.querySelector(
		'.service-item-net-value'
	).value;
	const net = serviceTr.querySelector('.service-item-net-sum');

	net.value = `${(amount * netPerOnePiece).toFixed(2)} PLN`.replace('.', ',');
	calculateItemTotalGross(serviceTr);
};

const calculateItemTotalGross = (serviceTr) => {
	const tax = serviceTr.querySelector('.service-item-tax').value;
	const netValue = serviceTr.querySelector('.service-item-net-sum').value;
	const sumGross = serviceTr.querySelector('.service-item-gross-sum');

	const totalGross =
		parseFloat(tax) * parseFloat(netValue.replace(',', '.')) +
		parseFloat(netValue.replace(',', '.'));

	sumGross.value = `${totalGross.toFixed(2)} PLN`.replace('.', ',');

	calculateTableSummary();
};

const changeValueInHiddenInput = (valueString, inputIdString) => {
	const input = document.querySelector(inputIdString);
	input.value = valueString;
};

const calculateInvoiceTotalNet = () => {
	const allNetValues = document.querySelectorAll('.service-item-net-sum');
	const invoiceTotalNetSpan = document.querySelector('.invoice-total-net');
	let sum = 0;

	allNetValues.forEach((el) => {
		sum += parseFloat(el.value.replace(',', '.'));
	});

	invoiceTotalNetSpan.textContent = `${sum.toFixed(2)} PLN`.replace('.', ',');

	changeValueInHiddenInput(sum.toFixed(2), '#total-net');
};

const calculateInvoiceTotalGross = () => {
	const allGrossValues = document.querySelectorAll('.service-item-gross-sum');
	const invoiceTotalGrossSpan = document.querySelector(
		'.invoice-total-gross'
	);
	let sum = 0;

	allGrossValues.forEach((el) => {
		sum += parseFloat(el.value.replace(',', '.'));
	});

	invoiceTotalGrossSpan.textContent = `${sum.toFixed(2)} PLN`.replace(
		'.',
		','
	);

	changeValueInHiddenInput(sum.toFixed(2), '#total-gross');
	changeValueInHiddenInput(sum.toFixed(2), '#to-pay-numeric');
	changeValueInHiddenInput(verbalNotation(sum.toFixed(2)), '#to-pay-verbal');
};

const calculateTableSummary = () => {
	calculateInvoiceTotalNet();
	calculateInvoiceTotalGross();
};

document.addEventListener('input', (e) => {
	if (
		e.target.classList.contains('service-item-amount') ||
		e.target.classList.contains('service-item-net-value')
	) {
		calculateItemTotalNet(e.target.parentElement.parentElement);
	}

	if (e.target.classList.contains('service-item-tax')) {
		calculateItemTotalGross(e.target.parentElement.parentElement);
	}
});

// ============================================================
// DELETE SERVICE ITEM
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
// UPDATE SERVICES TABLE AFTER LOAD PAGE
const updateServicesTable = () => {
	updateItemsNumbers();
	showEmptyInfo();
	calculateTableSummary();
};

document.addEventListener('DOMContentLoaded', updateServicesTable);

// ============================================================
// Block the form from being sent automatically by pressing the Enter key
document.addEventListener('keydown', (e) => {
	if (e.key === 'Enter' && e.target.localName !== 'textarea') {
		e.preventDefault();
	}
});
