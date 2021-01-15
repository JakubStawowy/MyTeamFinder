
const signInButtons = document.querySelectorAll('.sign-in');
const signOutButtons = document.querySelectorAll('.sign-out');

function signUserForEvent(){
    const container = this.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");
    const signedUsers = document.querySelector("#event-signed-players-"+id);
    const signButton = document.querySelector('#sign-'+id);
    fetch(`/signUpUserForEvent/${id}`).then(function (){
       signedUsers.innerHTML = parseInt(signedUsers.innerHTML) + 1;
       signButton.innerHTML = "Success!";
       signButton.removeEventListener("click", signUserForEvent);
    });
}


function signOutUserFromEvent(){
    const container = this.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");
    const signedUsers = document.querySelector("#event-signed-players-"+id);
    const signButton = document.querySelector('#sign-out-'+id);
    fetch(`/signOutUserFromEvent/${id}`).then(function (){
        signedUsers.innerHTML = parseInt(signedUsers.innerHTML) - 1;
        signButton.innerHTML = "Success!";
        signButton.removeEventListener("click", signOutUserFromEvent);
    });
}

signInButtons.forEach(button => button.addEventListener("click", signUserForEvent));
signOutButtons.forEach(button=>button.addEventListener("click", signOutUserFromEvent))
