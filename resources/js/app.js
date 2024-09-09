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

                let html = "";
                data.rooms.forEach((room) => {
                    html += `
                    <div class="bg-gray-200 rounded-lg px-3 py-2">
                            <h5 class="text-blue-600">Room: ${room.roomId}</h5>
                            `;
                    room.rates.forEach((rate) => {
                        html += `
                            <p class="text-gray-600">Price: ${rate.price}</p>
                            `;
                    });

                    html += `                
                    </div>
                    `;
                });

                $hotels.innerHTML = html;
            }
        })
        .catch((error) => {
            console.error(error);
        });
});
