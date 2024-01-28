let logo = document.querySelector(".logo");

function handleTimeSlotClick(event) {
    const buttons = event.target.parentElement.getElementsByClassName('hour');

    for (let i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('selected');
    }

    event.target.classList.add('selected');
}

function handleDaySlotClick(event) {
    const doctorCard = event.currentTarget.closest('.schedule');

    const dayButtons = doctorCard.getElementsByClassName('day');
    for (let i = 0; i < dayButtons.length; i++) {
        dayButtons[i].classList.remove('selected');
    }

    console.log(event.currentTarget.querySelector("div:nth-child(2)").innerHTML);
    console.log(event.currentTarget.querySelector("div:nth-child(3)").innerHTML);
    console.log(event.currentTarget.querySelector("div:nth-child(4)").innerHTML);

    const date = event.currentTarget.querySelector("div:nth-child(4)").innerHTML + '-'
        + event.currentTarget.querySelector("div:nth-child(3)").innerHTML + '-'
        + event.currentTarget.querySelector("div:nth-child(2)").innerHTML;

    console.log(date);

    const doctor = event.currentTarget.closest('.doctor');
    console.log(doctor);

    fetch('/getVisitsByDateAndDoctor', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({date: date, doctor: doctor.id})
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            console.log(response);
            return response.json();
        })
        .then(data => {
            updateVisitsDisplay(data, doctor);
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });

    const hourButtons = doctorCard.getElementsByClassName('hour');
    for (let i = 0; i < hourButtons.length; i++) {
        hourButtons[i].classList.remove('selected');
    }
    event.currentTarget.classList.add('selected');
}

function updateVisitsDisplay(visitsData, doctor) {

    const hoursContainer = doctor.querySelector(".hours");

    console.log(hoursContainer);
    hoursContainer.innerHTML = "";

    visitsData.forEach(visit => {
        const hourElement = document.createElement('div');
        hourElement.classList.add("hour");
        hourElement.id = visit.id;
        const date = new Date(visit.date);
        const hours = date.getHours();
        const minutes = date.getMinutes();
        const formattedHours = hours.toString().padStart(2, '0');
        const formattedMinutes = minutes.toString().padStart(2, '0');
        hourElement.textContent = `${formattedHours}:${formattedMinutes}`;
        hourElement.addEventListener('click', handleTimeSlotClick);
        hoursContainer.appendChild(hourElement)
    })

}


const timeSlots = document.getElementsByClassName('hour');
for (let i = 0; i < timeSlots.length; i++) {
    timeSlots[i].addEventListener('click', handleTimeSlotClick);
}

const daySlots = document.getElementsByClassName('day');
for (let i = 0; i < daySlots.length; i++) {
    daySlots[i].addEventListener('click', handleDaySlotClick);
}

const submitButtons = document.querySelectorAll('.doctor button');

submitButtons.forEach(function (button) {
    button.addEventListener('click', function () {
        let doctorCard = button.previousElementSibling;

        if (doctorCard && doctorCard.classList.contains('doctorCard')) {
            let selectedDayDiv = doctorCard.querySelector('.days .selected');
            let selectedHour = doctorCard.querySelector('.hours .selected');

            if (selectedDayDiv && selectedHour) {
                console.log(selectedHour.id);

                fetch('/reserveVisit', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({id: selectedHour.id})
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        console.log(response);
                        return response.json();
                    })
                    .then(data => {
                        console.log(data);
                        if (data.response === 'Visit already reserved!') {
                            window.location.href = `/confirm?message=Visit already reserved!`
                        } else if (data.response === 'Visit successfully reserved') {
                            window.location.href = `/confirm?message=Visit successfully reserved&id=${data.id}`
                        }
                    })
                    .catch(error => {
                        console.error('There has been a problem with your fetch operation:', error);
                    });

            } else {
                alert('Please select day and time of the appointment.');
            }
        } else {
            console.log('DoctorCard sibling not found for this button');
        }

    });
});

document.addEventListener('DOMContentLoaded', function () {
    const logo = document.querySelector('.logo img');

    logo.addEventListener('click', function () {
        window.location.href = '/menu';
    });
});