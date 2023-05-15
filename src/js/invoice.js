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
