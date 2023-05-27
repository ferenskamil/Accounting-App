// OPEN / HIDE EDIT FORM
const invoiceEditBtn = document.querySelector('.invoice__settings-edit');
const invoiceEditBackBtn = document.querySelector('.invoice__edit-back');
const invoiceEditForm = document.querySelector('.invoice__edit');
const invoiceView = document.querySelector('.invoice__container');
const invoiceSettings = document.querySelector('.invoice__settings');

const openInvoiceEditForm = () => {
	invoiceEditForm.style.display = 'block';
	invoiceView.style.display = 'none';
	invoiceSettings.style.display = 'none';
};

const closeInvoiceEditForm = () => {
	invoiceEditForm.style.display = 'none';
	invoiceView.style.display = 'flex';
	invoiceSettings.style.display = 'flex';
};

invoiceEditBtn.addEventListener('click', openInvoiceEditForm);
invoiceEditBackBtn.addEventListener('click', closeInvoiceEditForm);

// =============================================
// EDIT FORM VALIDATION
const allInputs = document.querySelectorAll('.invoice__edit-form-box input');
const submitBtnEditForm = document.querySelector(
	'.invoice__edit-form-box-submit-btn button'
);

const validationInvoiceEditForm = (e) => {
	// prevent default only for testing
	e.preventDefault();

	let isOK = true;
	allInputs.forEach((input) => {
		input.classList.remove('invoice__edit-form-box-input--empty');

		if (input.value === '') {
			input.classList.add('invoice__edit-form-box-input--empty');
			isOK = false;
		}
	});

	// Block submit form if any input is empty
	if (!isOK) e.preventDefault();

	return isOK;
};

submitBtnEditForm.addEventListener('click', (e) =>
	validationInvoiceEditForm(e)
);

// =============================================
// TRANSFERRING DATA FROM EDIT FORM TO PREVIEW
const transferDataFromEditFormToPreview = () => {
	const invoiceNoEditForm = document.querySelector('#invoice-no-edit').value;
	const dateEditForm = document.querySelector('#date-edit').value;
	const cityEditForm = document.querySelector('#city-edit').value;
	const bankEditForm = document.querySelector('#bank-edit').value;
	const accountNoEditForm = document.querySelector('#account-no-edit').value;
	const termEditForm = document.querySelector('#term-edit').value;

	const sellerNameEditForm =
		document.querySelector('#seller-name-edit').value;
	const sellerAddress1EditForm = document.querySelector(
		'#seller-address1-edit'
	).value;
	const sellerAddress2EditForm = document.querySelector(
		'#seller-address2-edit'
	).value;
	const sellerNIPEditForm = document.querySelector('#seller-NIP-edit').value;

	const customerNameEditForm = document.querySelector(
		'#customer-name-edit'
	).value;
	const customerAddress1EditForm = document.querySelector(
		'#customer-address1-edit'
	).value;
	const customerAddress2EditForm = document.querySelector(
		'#customer-address2-edit'
	).value;
	const customerNIPEditForm =
		document.querySelector('#customer-NIP-edit').value;

	const commentTextAreaEditForm =
		document.querySelector('#comment-edit').value;

	let invoiceNoView = document.querySelector('#invoice-no-view');
	let dateView = document.querySelector('#date-view');
	let cityView = document.querySelector('#city-view');
	let bankView = document.querySelector('#bank-view');
	let accountNoView = document.querySelector('#account-no-view');
	let termView = document.querySelector('#term-view');

	let sellerNameView = document.querySelector('#seller-name-view');
	let sellerAddress1View = document.querySelector('#seller-address1-view');
	let sellerAddress2View = document.querySelector('#seller-address2-view');
	let sellerNIPView = document.querySelector('#seller-NIP-view');

	let customerNameView = document.querySelector('#customer-name-view');
	let customerAddress1View = document.querySelector(
		'#customer-address1-view'
	);
	let customerAddress2View = document.querySelector(
		'#customer-address2-view'
	);
	let customerNIPView = document.querySelector('#customer-NIP-view');

	const commentTextAreaView = document.querySelector('#comment-view');

	invoiceNoView.textContent = invoiceNoEditForm;
	dateView.textContent = dateEditForm;
	cityView.textContent = cityEditForm;
	bankView.textContent = bankEditForm;
	accountNoView.textContent = accountNoEditForm;
	termView.textContent = termEditForm;

	sellerNameView.textContent = sellerNameEditForm;
	sellerAddress1View.textContent = sellerAddress1EditForm;
	sellerAddress2View.textContent = sellerAddress2EditForm;
	sellerNIPView.textContent = sellerNIPEditForm;

	customerNameView.textContent = customerNameEditForm;
	customerAddress1View.textContent = customerAddress1EditForm;
	customerAddress2View.textContent = customerAddress2EditForm;
	customerNIPView.textContent = customerNIPEditForm;

	commentTextAreaView.textContent = commentTextAreaEditForm;
};

submitBtnEditForm.addEventListener('click', transferDataFromEditFormToPreview);

// =============================================
// DISPLAY (OR NOT) EDIT FORM AFTER LOAD PAGE

const editFormOnLoaded = (e) => {
	if (!validationInvoiceEditForm(e)) {
		openInvoiceEditForm();
	} else {
		transferDataFromEditFormToPreview();
	}
};

document.addEventListener('DOMContentLoaded', (e) => editFormOnLoaded(e));

// ============================================================
// SANITIZE VALUE IN BANK ACCOUNT INPUT
const accountNoInput = document.querySelector('#account-no-edit');
const sanitizeAccountNoInput = (e) => {
	// In the future I can to this with regex
	let accountNoString = accountNoInput.value;
	let workString;

	if (!parseInt(e.data) && e.data !== '0') {
		accountNoString = accountNoString.slice(0, -1);
	}

	switch (accountNoString.length) {
		case 2:
			workString = ''.concat(accountNoString.slice(0, 2), ' ');
			break;
		case 7:
			workString = ''.concat(accountNoString.slice(0, 7), ' ');
			break;
		case 12:
			workString = ''.concat(accountNoString.slice(0, 12), ' ');
			break;
		case 17:
			workString = ''.concat(accountNoString.slice(0, 17), ' ');
			break;
		case 22:
			workString = ''.concat(accountNoString.slice(0, 22), ' ');
			break;
		case 27:
			workString = ''.concat(accountNoString.slice(0, 27), ' ');
			break;
		case 33:
			accountNoString = accountNoString.slice(0, -1);
			break;
		default:
			break;
	}

	if (workString) {
		accountNoString = workString;
	}
	accountNoInput.value = accountNoString;
};

accountNoInput.addEventListener('input', (e) => sanitizeAccountNoInput(e));

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
	<input type="text" value="${'Carbonara'}">`;

	const activityCode = document.createElement('td');
	activityCode.innerHTML = `<span class="service-title--mobile">Kod PKWiU: </span>
	<input type="text" value="${'56.21.11.0'}">`;

	const amount = document.createElement('td');
	amount.innerHTML = `<span class="service-title--mobile">Ilość: </span>
	<input type="number" value="1" class="service-item-amount">`;

	const netPrice = document.createElement('td');
	netPrice.innerHTML = `<span class="service-title--mobile">Cena netto (zł): </span>
	<input type="number" name="" id=""value="0" class="service-item-net-value">`;

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
};

addNewServiceBtn.addEventListener('click', (e) => createNewServiceItem(e));

// ============================================================
// CALCULATE VALUES IN SERVICE ITEM

const calculateTotalNet = (e) => {
	const item = e.target.parentElement.parentElement;
	const amount = item.querySelector('.service-item-amount').value;
	const netValue = item.querySelector('.service-item-net-value').value;
	const totalNetValue = item.querySelector('.service-item-net-sum');

	calculateTotalGross(e);
	totalNetValue.value = `${amount * netValue} zł`;
};

const calculateTotalGross = (e) => {
	const item = e.target.parentElement.parentElement;
	const tax = item.querySelector('.service-item-tax').value;
	const netValue = item.querySelector('.service-item-net-value').value;
	const sumGrossValue = item.querySelector('.service-item-gross-sum');

	const totalGross =
		parseFloat(tax) * parseFloat(netValue) + parseFloat(netValue);
	sumGrossValue.value = `${totalGross.toFixed(2)} zł`;
};

document.addEventListener('input', (e) => {
	if (
		e.target.classList.contains('service-item-amount') ||
		e.target.classList.contains('service-item-net-value')
	) {
		calculateTotalNet(e);
	}

	if (e.target.classList.contains('service-item-tax')) {
		calculateTotalGross(e);
	}
});

// ============================================================
// NOTES
// key shortcuts for testing
// const keyShortcuts = (e) => {
// 	if (e.key === 'Enter') {
// 	}
// };
// document.addEventListener('keydown', (e) => keyShortcuts(e));
