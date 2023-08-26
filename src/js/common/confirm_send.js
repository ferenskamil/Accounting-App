/*
The script responsible for displaying the message before sending the email.
In the dialog box, the user will be able to select:
- whether he wants to edit the invoice?
- whether he wants to send the invoice?
- whether he wants to cancel?

Now, there are only functions in the script. In the future,
you can make it a "ConfirmMess" object with specific methods.
*/
// - - - - - - -
// Helper
const copyValueToSpan = (fromElementSelector, toElementSelector) => {
	const fromElement = document.querySelector(fromElementSelector);
	const toElement = document.querySelector(toElementSelector);
	toElement.textContent = fromElement.textContent;
};

// - - - - - - -
// Show Confirm message
const sendBtn = document.querySelector('.send-btn');
const showSendConfirmMessage = () => {
	const confirmMessage = document.querySelector('.confirm-send__shadow');
	confirmMessage.classList.add('confirm-send__shadow--active');

	// Insert to confirm message basic info about invoice
	copyValueToSpan('.invoice-no', '.confirm-send-no');
	copyValueToSpan('.invoice-date', '.confirm-send-date');
	copyValueToSpan('.invoice-city', '.confirm-send-city');
	copyValueToSpan('.invoice-bank', '.confirm-send-bank');
	copyValueToSpan('.invoice-account-no', '.confirm-send-account-no');
	copyValueToSpan('.invoice-term', '.confirm-send-term');
	copyValueToSpan('.invoice-to-pay', '.confirm-send-to-pay');
	copyValueToSpan('.invoice-name', '.confirm-send-name');
	copyValueToSpan('.invoice-address1', '.confirm-send-address1');
	copyValueToSpan('.invoice-address2', '.confirm-send-address2');
	copyValueToSpan('.invoice-company-code', '.confirm-send-company-code');

	// Set invoice no. as values of hidden inputs
	const invoiceNo = document.querySelector('.invoice-no');
	const editBtnHiddenInput = document.querySelector(
		'#confirm-send-edit-btn-hidden-input'
	);
	const sendBtnHiddenInput = document.querySelector(
		'#confirm-send-send-btn-hidden-input'
	);

	editBtnHiddenInput.value = invoiceNo.textContent;
	sendBtnHiddenInput.value = invoiceNo.textContent;
};
sendBtn.addEventListener('click', showSendConfirmMessage);

// - - - - - - -
// Hide Confirm message
const returnBtn = document.querySelector(
	'.confirm-send__pop-up-buttons-return'
);
const hideSendConfirmMess = () => {
	const confirmMessage = document.querySelector('.confirm-send__shadow');
	confirmMessage.classList.remove('confirm-send__shadow--active');
};

returnBtn.addEventListener('click', hideSendConfirmMess);

// - - - - - - -
// Update hidden input with recipient email
const recipientEmailInput = document.querySelector(
	'#confirm-send__pop-up-email'
);

const updateRecipientEmail = () => {
	const emailHiddenInput = document.querySelector(
		'#pop-up-email-hidden-input'
	);
	emailHiddenInput.value = recipientEmailInput.value;
};

recipientEmailInput.addEventListener('input', updateRecipientEmail);
