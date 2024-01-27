const dateDisplay = document.querySelector(".date");
document.addEventListener('DOMContentLoaded', function () {

    let logo = document.querySelector('.logo img'); // Select the logo image

    logo.addEventListener('click', function() {
        window.location.href = '/doctorMenu';
    });

    const todayButton = document.querySelector('.today');

    todayButton.addEventListener('click', function () {

        const today = new Date().toISOString().split('T')[0];

        console.log(today);


        fetch('/getVisitsByDate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({date: today})
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                updateVisitsDisplay(data, today);
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
    });


    const nextButton = document.querySelector('.next');

    nextButton.addEventListener('click', function () {

        const date = document.querySelector('.date');

        const today = new Date(date.textContent);


        const tomorrow = new Date(today.getTime() + (24 * 60 * 60 * 1000));

        const formattedDate = tomorrow.toISOString().split('T')[0];


        fetch('/getVisitsByDate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({date: formattedDate})
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                console.log(response);
                return response.json();
            })
            .then(data => {
                updateVisitsDisplay(data, formattedDate);
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
    });


    const prevButton = document.querySelector('.previous');

    prevButton.addEventListener('click', function () {

        const date = document.querySelector('.date');

        const today = new Date(date.textContent);


        const prevDay = new Date(today.getTime() - (24 * 60 * 60 * 1000));

        const formattedDate = prevDay.toISOString().split('T')[0];


        fetch('/getVisitsByDate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({date: formattedDate})
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                console.log(response);
                return response.json();
            })
            .then(data => {
                updateVisitsDisplay(data, formattedDate);
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
    });


});

function updateVisitsDisplay(visitsData, date) {
    const visitsContainer = document.querySelector('.visits');
    const template = document.querySelector("#visit-template")

    dateDisplay.innerHTML = date;
    console.log(date);
    console.log(visitsData);

    visitsContainer.innerHTML = '';
    visitsData.forEach(visit => {
        const clone = template.content.cloneNode(true);
        const date = clone.querySelector('div:nth-child(1)');
        date.innerHTML = visit.date;
        const patient = clone.querySelector('div:nth-child(2)');
        patient.innerHTML = visit.patient;
        visitsContainer.appendChild(clone);
    });
}


