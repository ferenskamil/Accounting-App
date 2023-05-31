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

	showEmptyInfo();
	calculateTableSummary();
};

const closeInvoiceEditForm = () => {
	invoiceEditForm.style.display = 'none';
	invoiceView.style.display = 'flex';
	invoiceSettings.style.display = 'flex';
};

invoiceEditBtn.addEventListener('click', openInvoiceEditForm);
invoiceEditBackBtn.addEventListener('click', closeInvoiceEditForm);

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