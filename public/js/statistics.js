
const signButtons = document.querySelectorAll('.sign-in');

function signUserForEvent(){
    const container = this.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");
    alert(id)
    const signedUsers = document.getElementById("event-signed-players-"+id);
    fetch(`/signUpUserForEvent/${id}`).then(function (){
       signedUsers.innerHTML = parseInt(signedUsers.innerHTML) + 1;
       alert("You have been successfully signed for that event!");
    });

}

signButtons.forEach(button => button.addEventListener("click", signUserForEvent));
