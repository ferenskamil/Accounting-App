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
// Show Confirm message
const sendBtn = document.querySelector('.send-btn');
const showSendConfirmMessage = () => {
	const confirmMessage = document.querySelector('.confirm-send__shadow');
	confirmMessage.classList.add('confirm-send__shadow--active');
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
