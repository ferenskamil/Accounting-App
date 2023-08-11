const showInfoWhenInvoiceListIsEmpty = () => {
	const invoices = document.querySelectorAll('.invoice-list__table-tbody tr');

	const noInvoicesInfo = document.querySelector(
		'.invoice-list__table-tbody-empty_info'
	);

	if (invoices.length === 1) {
		noInvoicesInfo.classList.add(
			'invoice-list__table-tbody-empty_info--active'
		);
	}
};

document.addEventListener('DOMContentLoaded', showInfoWhenInvoiceListIsEmpty);
