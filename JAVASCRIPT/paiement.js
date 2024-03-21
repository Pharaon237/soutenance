let cardNumberInput = document.getElementById('cardNumberInput');
let cardType = document.getElementById('cardType')


cardNumberInput.addEventListener('input', onCardInput);
cardNumberInput.addEventListener('change', onCardNumberChange);


function onCardInput(evt){
    if(evt.inputType === 'insetText' && !(/[0-9]/.test(evt.data))){
        evt.preventDefault();
        evt.target.value=evt.target.value.substr(0, evt.target.value.length - 1);
        return;
    }

    const  MASTERCARD_REGEX = /^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11}|(?:6(?:5|7)\d{7}|6(?:6|9)\d{7}))$/;
    const VISA_REGEX = /^4[0-9]{12}(?:[0-9]{3})?$/;

    cardType.className="card-type";
    cardType.removeAttribute('title');
    if(MASTERCARD_REGEX.test(evt.target.value)){

    }else if(VISA_REGEX.test(evt.target.value)){

    }else if(isValidcardNumber(evt.target.value)){

    }
}

function onCardNumberChange(evt){
    if(isValidcardNumber(evt.target.value)){
        cardNumberInput.classList.remove('invalid');
        cardType.classList.remove('is-error');
        cardType.setAttribute('title',"valid card number");
    }else{
        cardNumberInput.classList.add('invalid');
        cardType.classList.add('is-error');
        cardType.setAttribute('title',"Invalid card number");
    }
}

function isValidcardNumber(cardNumber){
    const VALID_REGEX = /(^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11}|(?:6(?:5|7)\d{7}|6(?:6|9)\d{7}))$)/;
    return VALID_REGEX.test(cardNumber);
}