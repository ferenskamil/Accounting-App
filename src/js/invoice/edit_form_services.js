// ============================================================
// DISPLAY INFO WHEN TBODY IS EMPTY

const servicesTbody = document.querySelector(
	'.invoice__edit-form-box-services-table tbody'
);
const addNewServiceBtn = document.querySelector('.new-service-btn');

const showEmptyInfo = () => {
	const services = servicesTbody.querySelectorAll('tr');
	const emptyInfo = servicesTbody.querySelector('.empty-info');

	if (services.length === 1) {
		emptyInfo.style.display = 'grid';
	} else if (services.length > 1) {
		emptyInfo.style.display = 'none';
	}
};

// ============================================================
// ADD SERVICE AFTER CLICK THE"ADD" BUTTON

const updateItemsNumbers = () => {
	const itemsNoSpans = document.querySelectorAll(
		'.invoice__edit-form-box-services-table .service-item-number'
	);

	for (let i = 0; i < itemsNoSpans.length; i++) {
		itemsNoSpans[i].textContent = i + 1;
	}
};

const createNewService = (e) => {
	e.preventDefault();

	const newItem = document.createElement('tr');
	const itemNoSpan = document.createElement('td');
	itemNoSpan.innerHTML = `<span class="service-title--mobile">No.: </span><span class="service-item-number"></span>`;

	const serviceName = document.createElement('td');
	serviceName.innerHTML = `<span class="service-title--mobile">Item / service: </span>
	<input class="service-item-name" type="text" value="${''}">`;

	const activityCode = document.createElement('td');
	activityCode.innerHTML = `<span class="service-title--mobile">Service code: </span>
	<input class="service-item-code" type="text" value="${'56.21.11.0'}">`;

	const amount = document.createElement('td');
	amount.innerHTML = `<span class="service-title--mobile">Quantity: </span>
	<input type="number" value="1" min="0" class="service-item-amount">`;

	const netValue = document.createElement('td');
	netValue.innerHTML = `<span class="service-title--mobile">Net price (PLN): </span>
	<input type="number" name="" id="" min="0" value="0" class="service-item-net-value">`;

	const taxValue = document.createElement('td');
	taxValue.innerHTML = `<span class="service-title--mobile">Tax: </span>
	<select name="" id="" class="service-item-tax">
		<option value="0">tax-free</option>
		<option value="0.08">8%</option>
		<option value="0.23">23%</option>
	</select>`;

	const netSum = document.createElement('td');
	netSum.innerHTML = `<span class="service-title--mobile">Net sum (PLN): </span>
	<input type="text" value="0.00 PLN" class="service-item-net-sum" disabled>`;

	const grossSum = document.createElement('td');
	grossSum.innerHTML = `<span class="service-title--mobile">Gross sum (PLN): </span>
	<input type="text" value="0.00 PLN" class="service-item-gross-sum" disabled>`;

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
};

addNewServiceBtn.addEventListener('click', (e) => createNewService(e));

// ============================================================
// CALCULATE VALUES IN SERVICE ITEM

const calculateItemTotalNet = (e) => {
	const item = e.target.parentElement.parentElement;
	const amount = item.querySelector('.service-item-amount').value;
	const netPerOnePiece = item.querySelector('.service-item-net-value').value;
	const net = item.querySelector('.service-item-net-sum');

	net.value = `${(amount * netPerOnePiece).toFixed(2)} PLN`;
	calculateItemTotalGross(e);
};

const calculateItemTotalGross = (e) => {
	const item = e.target.parentElement.parentElement;
	const tax = item.querySelector('.service-item-tax').value;
	const netValue = item.querySelector('.service-item-net-sum').value;
	const sumGross = item.querySelector('.service-item-gross-sum');

	const totalGross =
		parseFloat(tax) * parseFloat(netValue) + parseFloat(netValue);

	sumGross.value = `${totalGross.toFixed(2)} PLN`;

	calculateTableSummary();
};

const calculateInvoiceTotalNet = () => {
	const allNetValues = document.querySelectorAll('.service-item-net-sum');
	const invoiceTotalNetSpan = document.querySelector('.invoice-total-net');
	let sum = 0;

	allNetValues.forEach((el) => {
		sum += parseFloat(el.value);
	});

	invoiceTotalNetSpan.textContent = `${sum.toFixed(2)} PLN`;
};

const calculateInvoiceTotalGross = () => {
	const allGrossValues = document.querySelectorAll('.service-item-gross-sum');
	const invoiceTotalGrossSpan = document.querySelector(
		'.invoice-total-gross'
	);
	let sum = 0;

	allGrossValues.forEach((el) => {
		sum += parseFloat(el.value);
	});

	invoiceTotalGrossSpan.textContent = `${sum.toFixed(2)} PLN`;
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
		calculateItemTotalNet(e);
	}

	if (e.target.classList.contains('service-item-tax')) {
		calculateItemTotalGross(e);
	}
});

// ============================================================
// DELETE SERVICE ITEM
const deleteServiceItem = (e) => {
	e.preventDefault();

	const item = e.target.parentElement.parentElement;
	item.outerHTML = '';

	updateItemsNumbers();
	showEmptyInfo();
	calculateTableSummary();
};

document.addEventListener('click', (e) => {
	if (e.target.classList.contains('delete-btn')) {
		deleteServiceItem(e);
	}
});

// ============================================================
// NOTES
// key shortcuts for testing
// const keyShortcuts = (e) => {
// 	if (e.key === 'Enter') {
// 		transferServiceItemsFromEditFormToArr();
// 		displayServiceItemsInPreview();
// 	}
// };
// document.addEventListener('keydown', (e) => keyShortcuts(e));
