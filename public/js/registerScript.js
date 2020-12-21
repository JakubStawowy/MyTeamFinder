const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const confirmedPasswordInput = form.querySelector('input[name="confirm password"]');
const phoneInput = form.querySelector('input[name="phone"]');
function isEmailCorrect(email){
    return/\S+@\S+\.\S+/.test(email);
}
function arePasswordsSame(password, confirmedPassword){
    return password === confirmedPassword;
}
function markValidation(element, condition){
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}
function isPhoneCorrect(phone){
    return /^\d{10}$/.test(phone);
}
function validatePhone(){
    setTimeout(
        function (){
            markValidation(phoneInput, isPhoneCorrect(phoneInput.value))
        }
        ,
      1000
    );
}
function validateEmail(){
    setTimeout(
        function (){
            markValidation(emailInput, isEmailCorrect(emailInput.value));
        },
        1000
    );
}
function validatePassword(){
    setTimeout(
        function (){
            const condition = arePasswordsSame(
                confirmedPasswordInput.previousElementSibling.value,
                confirmedPasswordInput.value
            );
            markValidation(confirmedPasswordInput, condition);
        },
        1000
    );
}
emailInput.addEventListener('keyup', validateEmail);
confirmedPasswordInput.addEventListener('keyup', validatePassword);
phoneInput.addEventListener('keyup', validatePhone);

