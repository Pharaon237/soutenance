let cardNumberInput = document.getElementById('cardNumberInput');
let cardType = document.getElementById('cardType');
const cardNumberRegex = /^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11}|(?:6(?:5|7)\d{7}|6(?:6|9)\d{7})|6759\d{12}|6771\d{12})$/;

cardNumberInput.addEventListener('input', validateCard);
cardNumberInput.addEventListener('change', validateCard);

function validateCard(evt) {
    if (evt.inputType === 'insertText' && !(/[0-9]/.test(evt.data))) {
        evt.preventDefault();
        evt.target.value = evt.target.value.substr(0, evt.target.value.length - 1);
        return;
    }

    const isValid = cardNumberRegex.test(evt.target.value);
    updateCardTypeIndicator(isValid);
}

function updateCardTypeIndicator(isValid) {
    const cardTypeElement = document.getElementById('cardType');

    if (isValid) {
        cardNumberInput.classList.remove('invalid');

        const cardNumber = cardNumberInput.value;

        if (cardNumber.match(/^4/)) {
            cardTypeElement.classList.remove('is-error');
            cardTypeElement.classList.add('is-mastercard');
        } else if (cardNumber.match(/^5[1-5]/)) {
            cardTypeElement.classList.remove('is-error', 'is-mastercard');
        } else if (cardNumber.match(/^3[47]/)) {
            cardTypeElement.classList.remove('is-error', 'is-mastercard');
        } else if (cardNumber.match(/^6(?:5|7)/)) {
            cardTypeElement.classList.remove('is-error');
            cardTypeElement.classList.add('is-mtn');
        } else if (cardNumber.match(/^6771/)) {
            cardTypeElement.classList.remove('is-error');
            cardTypeElement.classList.add('is-orange');
        }
        cardTypeElement.setAttribute('title', "Valid card number");
    } else {
        cardNumberInput.classList.add('invalid');
        cardTypeElement.classList.remove('is-mastercard', 'is-mtn', 'is-orange');
        cardTypeElement.classList.add('is-error');
        cardTypeElement.setAttribute('title', "Invalid card number");
    }
}
