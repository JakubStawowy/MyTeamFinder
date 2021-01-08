const hamburgerButton = document.querySelector(".fa-bars");
const bottomMenu = document.querySelector(".bottom-menu")

hamburgerButton.addEventListener("click", function () {
    if(bottomMenu.classList.contains("bottom-menu-opened"))
        bottomMenu.classList.remove("bottom-menu-opened");
    else
        bottomMenu.classList.add("bottom-menu-opened");
});