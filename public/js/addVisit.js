document.addEventListener('DOMContentLoaded', function() {
    let logo = document.querySelector('.logo img'); // Select the logo image

    logo.addEventListener('click', function() {
        window.location.href = '/doctorMenu';
    });
});