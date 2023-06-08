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
		const netPrice = el.querySelector('.service-item-net-value').value;
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
	const numericSpan = document.querySelector('#invoice__sum-numeric');
	const verbalSpan = document.querySelector('#invoice__sum-verbal');

	const totalNetEditForm = document.querySelector('.invoice-total-net');
	const totalGrossEditForm = document.querySelector('.invoice-total-gross');

	const totalNetPreview = document.querySelector('.preview-total-net');
	const totalGrossPreview = document.querySelector('.preview-total-gross');

	totalNetPreview.textContent = totalNetEditForm.textContent;
	totalGrossPreview.textContent = totalGrossEditForm.textContent;
	numericSpan.textContent = parseFloat(totalGrossEditForm.textContent);

	verbalSpan.textContent = verbalNotation(numericSpan.textContent);
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

	displayServicesInPreview();
	displayInvoiceSummaryInPreview();
};

submitBtn.addEventListener('click', transferDataFromEditFormToPreview);
