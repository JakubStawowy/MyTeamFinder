const openFiltersButton = document.querySelector('.open-filters');
const openSearchButton = document.querySelector('.open-search');
const openAddSportButton = document.querySelector('.open-add-sport');
const closeButton = document.querySelectorAll('.fa-times-circle');
const filters = document.querySelector('.filters');
const search = document.querySelector('.search');
const addSport = document.querySelector('.add-sport');
const sportNameTextBox = document.querySelector('input[name="sport-name"]');
const addSportButton = document.querySelector('.add-sport-button');
const filterButton = filters.querySelector('.filter-button');
const filterInputs = filters.querySelectorAll('input');
const dateFromInput = filters.querySelector('input[name="dateFrom"]');
const dateToInput = filters.querySelector('input[name="dateTo"]');

if(addSport!=null && sportNameTextBox!=null && addSportButton!=null && openAddSportButton!=null){

    function validateSport() {
        setTimeout(function () {
            if(sportNameTextBox.value.length>0)
                addSportButton.classList.remove('input-disabled');
            else
                addSportButton.classList.add('input-disabled');
        }, 100);
    }

    sportNameTextBox.addEventListener('keyup', validateSport);
    sportNameTextBox.addEventListener('click', validateSport);

    openAddSportButton.addEventListener('click', function () {
        showForm(addSport);
        hideButton(openFiltersButton);
        hideButton(openAddSportButton);
        hideButton(openSearchButton);
    });

    addSportButton.addEventListener('click', function () {
       const sportName = sportNameTextBox.value;
       const sportType = document.querySelector('select').value;
       const result = sportName+'+'+sportType;
        alert(result);
       fetch(`/addSport/${result}`).then(function () {
           alert("udalo sie");
       });
    });

}

function hideButton(element){
    if(element.classList.contains('element')){
        element.classList.remove('element');
        element.classList.add('hidden-element');
    }
}

function showButton(element){
    if(element.classList.contains('hidden-element')){
        element.classList.add('element');
        element.classList.remove('hidden-element');
    }
}

function showForm(element){
    if(element.classList.contains('hidden-element')){
        element.classList.add('form-displayed');
        element.classList.remove('hidden-element');
    }
}

function hideForm(element){
    if(element.classList.contains('form-displayed')){
        element.classList.add('hidden-element');
        element.classList.remove('form-displayed');
    }
}

function validateFilters(){
    for(let i=0; i < filterInputs.length; i++){
        if(filterInputs[i].value.length>0)
            return true;
    }
    return false;
}


openFiltersButton.addEventListener('click', function (){
    showForm(filters);
    hideButton(openFiltersButton);
    if(openAddSportButton!=null){
        hideButton(openAddSportButton);
    }
    hideButton(openSearchButton);
});

filterInputs.forEach(filter=>filter.addEventListener('keyup',function () {
    setTimeout(function () {
        if(validateFilters()){
            filterButton.classList.remove('input-disabled');
        }
        else{
            filterButton.classList.add('input-disabled');
        }
    },100)
}))

openSearchButton.addEventListener('click', function () {
    showForm(search);
    hideButton(openFiltersButton);
    if(openAddSportButton!=null){
        hideButton(openAddSportButton);
    }
    hideButton(openSearchButton);
});

closeButton.forEach(close=>close.addEventListener('click', function () {
    hideForm(filters);
    hideForm(search);
    if(addSport!=null){
        hideForm(addSport);
    }

    showButton(openFiltersButton);
    if(openAddSportButton!=null){
        showButton(openAddSportButton);
    }
    showButton(openSearchButton);
}));

function isDateCorrect(date) {
    return/[0-9]{4}-(0[1-9]|1[0-2])-[0-9]{2}/.test(date.substr(0, 10));
}

function isTimeCorrect(date){
    return/([0-1][0-9]|2[0-4]):([0-5][0-9])/.test(date.substr(11, 5));
}
function validateDateFrom(){
    setTimeout(function () {
        if((dateFromInput.value.length===10 && isDateCorrect(dateFromInput.value)) || (isDateCorrect(dateFromInput.value) && isTimeCorrect(dateFromInput.value)))
            dateFromInput.classList.remove('no-valid');
        else
            dateFromInput.classList.add('no-valid');
    }, 1000);
}
function validateDateTo(){
    setTimeout(function () {
        if((dateToInput.value.length===10 && isDateCorrect(dateToInput.value)) || (isDateCorrect(dateToInput.value) && isTimeCorrect(dateToInput.value)))
            dateToInput.classList.remove('no-valid');
        else
            dateToInput.classList.add('no-valid');
    }, 1000);
}
dateFromInput.addEventListener('keyup', validateDateFrom);
dateToInput.addEventListener('keyup', validateDateTo);