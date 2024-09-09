import "./bootstrap";

// get data from the form

const $ = (el) => document.querySelector(el);

const $errors = $("#errors");
const $hotels = $("#hotels");

$("form").addEventListener("submit", function (e) {
    e.preventDefault();
    // add crf token to the form data

    let formData = new FormData(e.target);
    let data = {
        hotelId: formData.get("hotelId"),
        checkIn: formData.get("checkIn"),
        checkOut: formData.get("checkOut"),
        numberOfGuests: formData.get("numberOfGuests"),
        numberOfRooms: formData.get("numberOfRooms"),
        currency: formData.get("currency"),
    };

    // send data to the server
    fetch("/api/search", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
        body: JSON.stringify(data),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.errors) {
                $errors.innerHTML = "";
                for (let error in data.errors) {
                    $errors.innerHTML += `<li>${data.errors[error]}</li>`;
                }
            } else {
                $errors.innerHTML = "";
                $hotels.innerHTML = "";
                data.hotels.forEach((hotel) => {
                    $("#hotels").innerHTML += `
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title>${hotel.name}</h5>
                            <p class="card-text">${hotel.description}</p>
                            <p class="card-text">Price: ${hotel.price}</p>
                            <p class="card-text">Rating: ${hotel.rating}</p>
                        </div>
                    </div>
                    `;
                });
            }
        })
        .catch((error) => {
            console.error(error);
        });
});
