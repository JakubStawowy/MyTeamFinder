const form = document.querySelector('form');

function isFormFilled() {
    const inputs = [
        'input[name="title"]',
        'input[name="sport"]',
        'input[name="numberOfPlayers"]',
        'textarea',
        'input[name="date"]',
        'input[name="time"]'
    ]
    for(let i=0; i<inputs.length; i++){
        if(isElementLengthNull(inputs[i]))
            return false;
    }
    return true;

}
function isElementLengthNull(element){
    return form.querySelector(element).value.length === 0;

}
function validateForm(){
    if(isFormFilled()){
        form.querySelector('button').classList.remove('input-disabled');

    }
    else{
        form.querySelector('button').classList.add('input-disabled');
    }
}

form.addEventListener('click', validateForm);
form.querySelectorAll('input').forEach(input=>input.addEventListener('keyup',validateForm));