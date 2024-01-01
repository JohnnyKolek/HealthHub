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
        // Find the sibling .doctorCard that precedes the button
        var doctorCard = button.previousElementSibling;

        // Assuming the .doctorCard is the immediate sibling, we proceed
        if (doctorCard && doctorCard.classList.contains('doctorCard')) {
            // Find the selected day and hour within this doctorCard
            var selectedDayDiv = doctorCard.querySelector('.days .selected');
            var selectedHour = doctorCard.querySelector('.hours .selected');

            // Check if a day and hour are selected
            if (selectedDayDiv && selectedHour) {
                // Get the individual parts of the day selection
                var dayOfWeek = selectedDayDiv.children[0].textContent.trim();
                var dateOfMonth = selectedDayDiv.children[1].textContent.trim();

                // Get the text content of the selected hour
                var hourText = selectedHour.textContent.trim();

                // Log the results to the console
                console.log('Selected Appointment:', dayOfWeek, dateOfMonth, hourText);
            } else {
                console.log('Please select a day and time for the appointment.');
            }
        } else {
            console.log('DoctorCard sibling not found for this button');
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    var logo = document.querySelector('.logo img'); // Select the logo image

    logo.addEventListener('click', function() {
        // Redirect to the /menu endpoint
        window.location.href = '/menu';
    });
});