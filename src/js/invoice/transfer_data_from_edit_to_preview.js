// =============================================
// TRANSFERRING DATA FROM EDIT FORM TO PREVIEW

const invoiceTbodyPreview = document.querySelector(
	'.invoice__paper table tbody'
);

let itemsArr = [];
class Service {
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

const transferDataFromEditFormToPreview = () => {
	displayInvoiceInfoInPreview();
	displayServicesInPreview();
	displayInvoiceSummaryInPreview();
	closeInvoiceEditForm();
};

const copyAndDisplay = (inputIdString, spanIdString) => {
	const fromWhere = document.querySelector(`${inputIdString}`).value;
	const toWhere = document.querySelector(`${spanIdString}`);
	toWhere.textContent = fromWhere;
};

const displayInvoiceInfoInPreview = () => {
	copyAndDisplay('#invoice-no-edit', '#invoice-no-view');
	copyAndDisplay('#date-edit', '#date-view');
	copyAndDisplay('#city-edit', '#city-view');
	copyAndDisplay('#bank-edit', '#bank-view');
	copyAndDisplay('#account-no-edit', '#account-no-view');
	copyAndDisplay('#term-edit', '#term-view');
	copyAndDisplay('#seller-name-edit', '#seller-name-view');
	copyAndDisplay('#seller-address1-edit', '#seller-address1-view');
	copyAndDisplay('#seller-address2-edit', '#seller-address2-view');
	copyAndDisplay('#seller-NIP-edit', '#seller-NIP-view');
	copyAndDisplay('#customer-name-edit', '#customer-name-view');
	copyAndDisplay('#customer-address1-edit', '#customer-address1-view');
	copyAndDisplay('#customer-address2-edit', '#customer-address2-view');
	copyAndDisplay('#customer-NIP-edit', '#customer-NIP-view');
	copyAndDisplay('#comment-edit', '#comment-view');
};

const getServicesFromEditFormToArr = () => {
	const servicesFromEditForm = document.querySelectorAll(
		'.invoice__edit-form-box-services-table tbody tr'
	);
	itemsArr = [];

	for (let i = 1; i < servicesFromEditForm.length; i++) {
		const el = servicesFromEditForm[i];

		const number = el.querySelector('.service-item-number').textContent;
		const name = el.querySelector('.service-item-name').value;
		const activityCode = el.querySelector('.service-item-code').value;
		const amount = el.querySelector('.service-item-amount').value;
		const netPrice =
			el.querySelector('.service-item-net-value').value + 'zł';
		const tax = el.querySelector('.service-item-tax').value;
		const netSum = el.querySelector('.service-item-net-sum').value;
		const grossSum = el.querySelector('.service-item-gross-sum').value;

		const service = new Service(
			number,
			name,
			activityCode,
			amount,
			netPrice,
			tax,
			netSum,
			grossSum
		);

		itemsArr.push(service);
	}
};

const displayServicesInPreview = () => {
	getServicesFromEditFormToArr();

	if (itemsArr.length !== 0) {
		invoiceTbodyPreview.innerHTML = '';

		itemsArr.forEach((el) => {
			const newServiceInPreview = document.createElement('tr');

			const number = document.createElement('td');
			number.innerHTML = el.number + '.';

			const name = document.createElement('td');
			name.innerHTML = el.name;

			const activityCode = document.createElement('td');
			activityCode.innerHTML = el.activityCode;

			const amount = document.createElement('td');
			amount.innerHTML = el.amount;

			const netPrice = document.createElement('td');
			netPrice.innerHTML = el.netPrice;

			const tax = document.createElement('td');
			if (el.tax === '0') {
				tax.innerHTML = 'zw';
			} else {
				tax.innerHTML = `${el.tax * 100}%`;
			}

			const netSum = document.createElement('td');
			netSum.innerHTML = el.netSum;

			const grossSum = document.createElement('td');
			grossSum.innerHTML = el.grossSum;

			newServiceInPreview.append(
				number,
				name,
				activityCode,
				amount,
				netPrice,
				tax,
				netSum,
				grossSum
			);

			invoiceTbodyPreview.append(newServiceInPreview);
		});
	}
};

const displayInvoiceSummaryInPreview = () => {
	const totalNetEditForm = document.querySelector('.invoice-total-net');
	const totalNetPreview = document.querySelector('.preview-total-net');
	totalNetPreview.textContent = totalNetEditForm.textContent;

	const totalGrossEditForm = document.querySelector('.invoice-total-gross');
	const totalGrossPreview = document.querySelector('.preview-total-gross');
	totalGrossPreview.textContent = totalGrossEditForm.textContent;

	const numericSpan = document.querySelector('#invoice__sum-numeric');
	const verbalSpan = document.querySelector('#invoice__sum-verbal');
	numericSpan.textContent = parseFloat(
		totalGrossEditForm.textContent
	).toFixed(2);
	verbalSpan.textContent = verbalNotation(numericSpan.textContent);
};

submitBtn.addEventListener('click', transferDataFromEditFormToPreview);
