const searchBar = document.querySelector('.search-area');
const searchButton = document.querySelector('.search-button');
const eventContainer = document.querySelector('.events');

function searchEvents(event){
        event.preventDefault();

        const data = {search: searchBar.value};

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

function validateSearch() {
    setTimeout(function () {
        if(searchBar.value.length>0)
            searchButton.classList.remove('input-disabled');
        else
            searchButton.classList.add('input-disabled');

    },100);
}

searchBar.addEventListener("keyup", function (event) {

        if(event.key === "Enter"){
            searchEvents(event);
        }
    });
searchBar.addEventListener("keyup", validateSearch);
searchBar.addEventListener("click", validateSearch);
searchButton.addEventListener('click', searchEvents);

filterButton.addEventListener('click', function (event) {
    event.preventDefault();
    const results = {
        spots: filters.spots.value,
        location: filters.location.value,
        dateFrom: filters.dateFrom.value,
        dateTo: filters.dateTo.value,
        sport: filters.sport.value
    }
    fetch("/filter", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(results)
    }).then(function (response){
        return response.json();
    }).then(function (result) {
        eventContainer.innerHTML="";
        loadEvents(result);
    })
})

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
    username.value = event.name+" "+event.surname;

    const signedPlayersSection = clone.querySelector(".signed-players-section");
    signedPlayersSection.innerHTML = "signed players: "+event.signed_players+"/"+event.number_of_players;

    const description = clone.querySelector('.event-description');
    description.innerHTML = event.description;

    const date = clone.querySelector('.fa-calendar-alt').querySelector('a');

    date.innerHTML = event.date.substring(0, 16);

    const location = clone.querySelector('.fa-map-marker-alt').querySelector('a');
    location.innerHTML = event.location;

    eventContainer.appendChild(clone);
}
