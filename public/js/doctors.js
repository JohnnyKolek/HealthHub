const element = document.querySelector(".days");

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

    const hourButtons = doctorCard.getElementsByClassName('hour');
    for (let i = 0; i < hourButtons.length; i++) {
        hourButtons[i].classList.remove('selected');
    }
    event.currentTarget.classList.add('selected');

    const hours = event.currentTarget.closest('.hours');

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

submitButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        let doctorCard = button.previousElementSibling;

        if (doctorCard && doctorCard.classList.contains('doctorCard')) {
            let selectedDayDiv = doctorCard.querySelector('.days .selected');
            let selectedHour = doctorCard.querySelector('.hours .selected');

            if (selectedDayDiv && selectedHour) {
                let dayOfWeek = selectedDayDiv.children[0].textContent.trim();
                let dateOfMonth = selectedDayDiv.children[1].textContent.trim();

                let hourText = selectedHour.textContent.trim();

                console.log('Selected Appointment:', dayOfWeek, dateOfMonth, hourText);
            } else {
                console.log('Please select a day and time for the appointment.');
            }
        } else {
            console.log('DoctorCard sibling not found for this button');
        }

        // window.location.href = '/confirm';
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const logo = document.querySelector('.logo img');

    logo.addEventListener('click', function() {
        window.location.href = '/menu';
    });
});