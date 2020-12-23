function onLoad(){

    const rightSidePanelNavButton = document.getElementById('nav-icon');
    const hiddenRightSidePanelNavButton = document.getElementById('nav-icon-hidden');
    const topScrollElements = document.getElementsByClassName("fa-angle-up");
    const openFiltersButton = document.getElementsByClassName('open-filters')[0];
    const closeFiltersButton = document.getElementsByClassName('fa-times-circle')[0];

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

    openFiltersButton.addEventListener('click', function (){
        document.getElementsByClassName('open-filters')[0].classList.remove('element');
        document.getElementsByClassName('open-filters')[0].classList.add('hidden-element');
        document.getElementsByClassName('filters')[0].classList.add('element');
        document.getElementsByClassName('filters')[0].classList.remove('hidden-element');
    });
    closeFiltersButton.addEventListener('click', function (){
        document.getElementsByClassName('open-filters')[0].classList.add('element');
        document.getElementsByClassName('open-filters')[0].classList.remove('hidden-element');
        document.getElementsByClassName('filters')[0].classList.remove('element');
        document.getElementsByClassName('filters')[0].classList.add('hidden-element');
    });
}
