const search = document.querySelector('input[placeholder="Title, description, user"]');
const searchButton = document.querySelector('.filter');
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
searchButton.addEventListener('click', searchEvents);

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

    const eventId = clone.querySelector("input[name='eventId']");
    eventId.value = event.id;

    const title = clone.querySelector(".title");
    title.value = event.title;

    const userId = clone.querySelector("input[name='userId']");
    userId.value = event.created_by;

    const username = clone.querySelector(".username");
    username.value = event.username+" "+event.surname;

    const signedPlayersSection = clone.querySelector(".signed-players-section");
    signedPlayersSection.innerHTML = "signed players: "+event.signed_players+"/"+event.number_of_players;

    const description = clone.querySelector('.event-description');
    description.innerHTML = event.description;

    eventContainer.appendChild(clone);
}
