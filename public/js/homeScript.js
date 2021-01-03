function onLoad(){

    const rightSidePanelNavButton = document.getElementById('nav-icon');
    const hiddenRightSidePanelNavButton = document.getElementById('nav-icon-hidden');
    const topScrollElements = document.getElementsByClassName("fa-angle-up");
    const openFiltersButton = document.getElementsByClassName('open-filters')[0];
    const closeFiltersButtons = document.getElementsByClassName('fa-times-circle');
    const openSearchingModeButton = document.getElementsByClassName('open-search')[0];

    rightSidePanelNavButton.addEventListener('click', function (){
        document.getElementById('right-side-bar').classList.add('hidden-element');
        document.getElementById('right-side-bar').classList.remove('flex-element');
        document.getElementById('right-side-bar-hidden').classList.add('flex-element');
        document.getElementById('right-side-bar-hidden').classList.remove('hidden-element');
    });

    hiddenRightSidePanelNavButton.addEventListener('click', function (){
        document.getElementById('right-side-bar').classList.add('flex-element');
        document.getElementById('right-side-bar').classList.remove('hidden-element');
        document.getElementById('right-side-bar-hidden').classList.add('hidden-element');
        document.getElementById('right-side-bar-hidden').classList.remove('flex-element');
    });

    for(let i = 0; i < topScrollElements.length; i++){
        topScrollElements[i].addEventListener('click', function (){
            window.scrollTo(0, 0);
        });
    }

    function hideElement(element){
        element.classList.remove('element');
        element.classList.add('hidden-element');
    }

    function showElement(element){

        element.classList.add('element');
        element.classList.remove('hidden-element');
    }

    openFiltersButton.addEventListener('click', function (){

        hideElement(document.getElementsByClassName('open-filters')[0]);
        hideElement(document.getElementsByClassName('open-search')[0]);

        document.getElementsByClassName('filters')[0].classList.add('form-displayed');
        document.getElementsByClassName('filters')[0].classList.remove('hidden-element');
    });

    closeFiltersButtons[0].addEventListener('click', function (){
        showElement(document.getElementsByClassName('open-filters')[0]);
        showElement(document.getElementsByClassName('open-search')[0]);

        document.getElementsByClassName('filters')[0].classList.remove('form-displayed');
        document.getElementsByClassName('filters')[0].classList.add('hidden-element');
    });

    closeFiltersButtons[1].addEventListener('click', function (){

        showElement(document.getElementsByClassName('open-filters')[0]);
        showElement(document.getElementsByClassName('open-search')[0]);
        document.getElementsByClassName('search')[0].classList.remove('form-displayed');
        document.getElementsByClassName('search')[0].classList.add('hidden-element');
    });
    openSearchingModeButton.addEventListener('click', function (){

        hideElement(document.getElementsByClassName('open-filters')[0]);
        hideElement(document.getElementsByClassName('open-search')[0]);
        document.getElementsByClassName('search')[0].classList.add('form-displayed');
        document.getElementsByClassName('search')[0].classList.remove('hidden-element');
    });
}
