const search = document.querySelector('input[placeholder="Title, description, user"]');
const searchButton = document.querySelector('input[class="filter"]');
const eventContainer = document.querySelector('.events');
function searchEvents(event){
    if(event.key === "Enter"){
        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (events) {
            eventContainer.innerHTML = "";

            loadEvents(events);
        });
    }
}
search.addEventListener("keyup", searchEvents);
searchButton.addEventListener('click', function () {
    alert("xd");
});

function loadEvents(events) {
    events.forEach(event => {
        console.log(event);
        createEvent(event);
    });
}

function createEvent(event) {

    const template = document.querySelector("#event-template");
    const clone = template.content.cloneNode(true);
    const image = clone.querySelector("img");
    image.src = `/public/uploads/${event.image}`;

    const title = clone.querySelector("h2");
    title.innerHTML = event.title;

    const author = clone.querySelector(".author");
    author.innerHTML = event.username+" "+event.surname;

    const signedPlayers = clone.querySelector("h4");
    signedPlayers.innerHTML = "signed players: "+event.signed_players+"/"+event.number_of_players;

    const description = clone.querySelector(".description");
    description.innerHTML = event.description;

    const location = clone.querySelector(".location");
    location.innerHTML = event.location;

    const date = clone.querySelector(".date");
    date.innerHTML = event.date;

    const eventId = clone.querySelector('input[name="eventId"]');
    eventId.value = event.id;

    eventContainer.appendChild(clone);
}
