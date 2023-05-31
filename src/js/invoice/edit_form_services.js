// ============================================================
// DISPLAY INFO WHEN TBODY IS EMPTY

const showEmptyInfo = () => {
	const tbody = document.querySelector(
		'.invoice__edit-form-box-services-table tbody'
	);
	const trItems = tbody.querySelectorAll('tr');
	const emptyInfo = tbody.querySelector('.empty-info');

	if (trItems.length === 1) {
		emptyInfo.style.display = 'grid';
	} else if (trItems.length > 1) {
		emptyInfo.style.display = 'none';
	}
};

// ============================================================
// ADD SERVICE AFTER "ADD" BUTTON
const addNewServiceBtn = document.querySelector('.new-service-btn');
const servicesList = document.querySelector(
	'.invoice__edit-form-box-services-table tbody'
);

const updateServiceItemNumbers = () => {
	const allSpans = document.querySelectorAll(
		'.invoice__edit-form-box-services-table .service-item-number'
	);

	for (let i = 0; i < allSpans.length; i++) {
		allSpans[i].textContent = i + 1;
	}
};

const createNewServiceItem = (e) => {
	e.preventDefault();

	const newItem = document.createElement('tr');
	const itemNoSpan = document.createElement('td');
	itemNoSpan.innerHTML = `<span class="service-title--mobile">Nr pozycji: </span><span class="service-item-number"></span>`;

	const serviceName = document.createElement('td');
	serviceName.innerHTML = `<span class="service-title--mobile">Nazwa towaru / usługi: </span>
	<input class="service-item-name" type="text" value="${'Carbonara'}">`;

	const activityCode = document.createElement('td');
	activityCode.innerHTML = `<span class="service-title--mobile">Kod PKWiU: </span>
	<input class="service-item-code" type="text" value="${'56.21.11.0'}">`;

	const amount = document.createElement('td');
	amount.innerHTML = `<span class="service-title--mobile">Ilość: </span>
	<input type="number" value="1" min="0" class="service-item-amount">`;

	const netPrice = document.createElement('td');
	netPrice.innerHTML = `<span class="service-title--mobile">Cena netto (zł): </span>
	<input type="number" name="" id="" min="0" value="0" class="service-item-net-value">`;

	const taxValue = document.createElement('td');
	taxValue.innerHTML = `<span class="service-title--mobile">Stawka VAT: </span>
	<select name="" id="" class="service-item-tax">
		<option value="0">zw</option>
		<option value="0.08">8%</option>
		<option value="0.23">23%</option>
	</select>`;

	const netSumAmount = document.createElement('td');
	netSumAmount.innerHTML = `<span class="service-title--mobile">Wartość netto (zł): </span>
	<input type="text" value="0 zł" class="service-item-net-sum" disabled>`;

	const grossSumAmount = document.createElement('td');
	grossSumAmount.innerHTML = `<span class="service-title--mobile">Wartość brutto (zł): </span>
	<input type="text" value="0 zł" class="service-item-gross-sum" disabled>`;

	const deleteBtn = document.createElement('td');
	deleteBtn.innerHTML = `<button class="delete-btn">
	<i class="fa-solid fa-trash"></i>Delete</button>`;

	newItem.append(
		itemNoSpan,
		serviceName,
		activityCode,
		amount,
		netPrice,
		taxValue,
		netSumAmount,
		grossSumAmount,
		deleteBtn
	);
	servicesList.append(newItem);

	updateServiceItemNumbers();
	showEmptyInfo();
};

addNewServiceBtn.addEventListener('click', (e) => createNewServiceItem(e));

// ============================================================
// CALCULATE VALUES IN SERVICE ITEM

const calculateItemTotalNet = (e) => {
	const item = e.target.parentElement.parentElement;
	const amount = item.querySelector('.service-item-amount').value;
	const netValue = item.querySelector('.service-item-net-value').value;
	const totalNetValue = item.querySelector('.service-item-net-sum');

	totalNetValue.value = `${amount * netValue} zł`;
	calculateItemTotalGross(e);
};

const calculateItemTotalGross = (e) => {
	const item = e.target.parentElement.parentElement;
	const tax = item.querySelector('.service-item-tax').value;
	const netValue = item.querySelector('.service-item-net-sum').value;
	const sumGrossValue = item.querySelector('.service-item-gross-sum');

	const totalGross =
		parseFloat(tax) * parseFloat(netValue) + parseFloat(netValue);

	sumGrossValue.value = `${totalGross.toFixed(2)} zł`;
	calculateTableSummary();
};

const calculateInvoiceTotalNet = () => {
	const itemTotalNetArr = document.querySelectorAll('.service-item-net-sum');
	const invoiceTotalNetSpan = document.querySelector('.invoice-total-net');
	let sum = 0;

	itemTotalNetArr.forEach((el) => {
		sum += parseFloat(el.value);
	});

	invoiceTotalNetSpan.textContent = `${sum} zł`;
};

const calculateInvoiceTotalGross = () => {
	const itemTotalGrossArr = document.querySelectorAll(
		'.service-item-gross-sum'
	);
	const invoiceTotalGrossSpan = document.querySelector(
		'.invoice-total-gross'
	);
	let sum = 0;

	itemTotalGrossArr.forEach((el) => {
		sum += parseFloat(el.value);
	});

	invoiceTotalGrossSpan.textContent = `${sum} zł`;
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

	updateServiceItemNumbers();
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
