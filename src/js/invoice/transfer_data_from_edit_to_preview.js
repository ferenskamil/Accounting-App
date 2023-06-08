// =============================================
// TRANSFERRING DATA FROM EDIT FORM TO PREVIEW

const invoiceTbodyPreview = document.querySelector(
	'.invoice__paper table tbody'
);

let itemsArr = [];
class serviceItem {
	constructor(
		number,
		name,
		activityCode,
		amount,
		netPrice,
		tax,
		netSum,
		grossSum
	) {
		this.number = number;
		this.name = name;
		this.activityCode = activityCode;
		this.amount = amount;
		this.netPrice = netPrice;
		this.tax = tax;
		this.netSum = netSum;
		this.grossSum = grossSum;
	}
}

const transferServiceItemsFromEditFormToArr = () => {
	const serviceItemsArr = document.querySelectorAll(
		'.invoice__edit-form-box-services-table tbody tr'
	);
	itemsArr = [];

	for (let i = 1; i < serviceItemsArr.length; i++) {
		const el = serviceItemsArr[i];

		const number = el.querySelector('.service-item-number').textContent;
		const name = el.querySelector('.service-item-name').value;
		const activityCode = el.querySelector('.service-item-code').value;
		const amount = el.querySelector('.service-item-amount').value;
		const netPrice = el.querySelector('.service-item-net-value').value;
		const tax = el.querySelector('.service-item-tax').value;
		const netSum = el.querySelector('.service-item-net-sum').value;
		const grossSum = el.querySelector('.service-item-gross-sum').value;

		const newItem = new serviceItem(
			number,
			name,
			activityCode,
			amount,
			netPrice,
			tax,
			netSum,
			grossSum
		);

		itemsArr.push(newItem);
	}
};

const displayServiceItemsInPreview = () => {
	transferServiceItemsFromEditFormToArr();

	if (itemsArr.length !== 0) {
		invoiceTbodyPreview.innerHTML = '';

		itemsArr.forEach((el) => {
			const newTr = document.createElement('tr');

			const numberTd = document.createElement('td');
			numberTd.innerHTML = el.number + '.';

			const activityCodeTd = document.createElement('td');
			activityCodeTd.innerHTML = el.activityCode;

			const amountTd = document.createElement('td');
			amountTd.innerHTML = el.amount;

			const netPriceTd = document.createElement('td');
			netPriceTd.innerHTML = el.netPrice;

			const taxTd = document.createElement('td');
			if (el.tax === '0') {
				taxTd.innerHTML = 'zw';
			} else {
				taxTd.innerHTML = `${el.tax * 100}%`;
			}

			const netSumTd = document.createElement('td');
			netSumTd.innerHTML = el.netSum;

			const grossSumTd = document.createElement('td');
			grossSumTd.innerHTML = el.grossSum;

			const nameTd = document.createElement('td');
			nameTd.innerHTML = el.name;

			newTr.append(
				numberTd,
				nameTd,
				activityCodeTd,
				amountTd,
				netPriceTd,
				taxTd,
				netSumTd,
				grossSumTd
			);

			invoiceTbodyPreview.append(newTr);
		});
	}
};

const displayInvoiceSummaryInPreview = () => {
	let amountNumSpan = document.querySelector('.invoice__sum-num');
	const editFormTotalNet = document.querySelector('.invoice-total-net');
	const editFormTotalGross = document.querySelector('.invoice-total-gross');

	const previewTotalNet = document.querySelector('.preview-total-net');
	const previewTotalGross = document.querySelector('.preview-total-gross');

	previewTotalNet.textContent = editFormTotalNet.textContent;
	previewTotalGross.textContent = editFormTotalGross.textContent;
	amountNumSpan.textContent = parseFloat(editFormTotalGross.textContent);

	changeNum(amountNumSpan.textContent);
};

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

	displayServiceItemsInPreview();
	displayInvoiceSummaryInPreview();
};

submitBtn.addEventListener('click', transferDataFromEditFormToPreview);