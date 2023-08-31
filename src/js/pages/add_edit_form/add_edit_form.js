import { formValidation } from '../../common/form_validation.js';

const addEditform = document.querySelector('.invoice-edit__form');
addEditform.addEventListener('submit', (e) => formValidation(e, addEditform));
