const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');
const passwordInput = form.querySelector('input[name="password"]');
const phoneInput = form.querySelector('input[name="phone"]');
const ageInput = form.querySelector('input[name="age"]');

function isEmailCorrect(email){
    return/\S+@\S+\.\S+/.test(email) || email.length===0;
}
function isPasswordCorrect(password) {
    return password.length>=8 || password.length===0;
}
function arePasswordsSame(password, confirmedPassword){
    return password === confirmedPassword;
}
function markValidation(element, condition){
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}
function showMessage(element, condition, message){
    !condition ? element.innerHTML = message : element.innerHTML = "";
}
function isPhoneCorrect(phone){
    return phone.match(/\d/g).length<=10;
}
function isAgeCorrect(age){
    return (age.match(/\d/g).length<=3 && age>0) || age.length===0;
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
function validateConfirmedPassword(){
    setTimeout(
        function (){
            const condition = arePasswordsSame(
                confirmedPasswordInput.previousElementSibling.value,
                confirmedPasswordInput.value
            );
            markValidation(confirmedPasswordInput, condition);
            if(form.querySelector(".password-message").textContent==='')
                showMessage(form.querySelector(".password-message"), condition, "Passwords does not match");
        },
        1000
    );
}
function validatePassword(){
    setTimeout(function () {
        const condition = isPasswordCorrect(passwordInput.value);
        markValidation(passwordInput, condition);
        showMessage(form.querySelector(".password-message"), condition, "Password must contain at least 8 characters!");
    }, 2000);
}

function validateAge(){
    setTimeout(function () {
        const condition = isAgeCorrect(ageInput.value);
        markValidation(ageInput, condition);
    }, 1000);
}
const formElements = form.querySelectorAll('input');
function isFormFilled() {
    for(let i=0; i<formElements.length; i++){
        if(formElements[i].value.length===0)
            return false;
    }
    return true;
}
function validateForm(){
    if(isFormFilled()){
        document.querySelector('button').classList.remove('input-disabled');
    }
    else{
        document.querySelector('button').classList.add('input-disabled');
    }
}
formElements.forEach(input=>input.addEventListener('keyup', validateForm));
form.addEventListener('click', validateForm);
emailInput.addEventListener('keyup', validateEmail);
confirmedPasswordInput.addEventListener('keyup', validateConfirmedPassword);
phoneInput.addEventListener('keyup', validatePhone);
passwordInput.addEventListener('keyup', validatePassword);
ageInput.addEventListener('keyup', validateAge);
