
const topScrollElements = document.querySelectorAll('.fa-angle-up')
const rightSidePanelNavButton = document.querySelector('#nav-icon');
const hiddenRightSidePanelNavButton = document.querySelector('#nav-icon-hidden');

rightSidePanelNavButton.addEventListener('click', function (){
    document.querySelector('.right-side-bar').classList.add('hidden-element');
    document.querySelector('.right-side-bar').classList.remove('flex-element');
    document.querySelector('.right-side-bar-hidden').classList.add('flex-element');
    document.querySelector('.right-side-bar-hidden').classList.remove('hidden-element');
});

hiddenRightSidePanelNavButton.addEventListener('click', function (){
    document.querySelector('.right-side-bar').classList.add('flex-element');
    document.querySelector('.right-side-bar').classList.remove('hidden-element');
    document.querySelector('.right-side-bar-hidden').classList.add('hidden-element');
    document.querySelector('.right-side-bar-hidden').classList.remove('flex-element');
});

topScrollElements.forEach(scrollToTop=>scrollToTop.addEventListener('click', function () {
    window.scrollTo(0, 0);
}));