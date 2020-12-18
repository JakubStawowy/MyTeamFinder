function onLoad(){

    const rightSidePanelNavButton = document.getElementById('nav-icon');
    const hiddenRightSidePanelNavButton = document.getElementById('nav-icon-hidden');
    const topScrollElements = document.getElementsByClassName("fa-angle-up");
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
}
