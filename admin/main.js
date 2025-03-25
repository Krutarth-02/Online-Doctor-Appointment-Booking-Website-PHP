// Get the Add Doctor button and the doctor form
const addDoctorButton = document.getElementById('add-doctor-btn');
const dashboard = document.getElementById('dashboard-label');
const doctorForm = document.getElementById('add-doctor-form');
const back = document.getElementById('totals-container');
const doctor = document.getElementById('doctor-list');
// Add an event listener to the Add Doctor button
addDoctorButton.addEventListener('click', function() {
    // Toggle the visibility of the doctor form
    if (doctorForm.style.display === 'none') {
        dashboard.style.display = 'none';
        back.style.display = 'none';
        addDoctorButton.style.display = 'none';
        doctorForm.style.display = 'flex';
        doctor.style.display = 'none';

    } else {
        doctorForm.style.display = 'none';  
    }
});
// Get the book appointment button, doctor card, search bar, and Book Appointment form
var bookAppointmentButton = document.querySelector('.book-btn');
var doctorCard = document.querySelector('.doctor-card');
var searchBar = document.querySelector('.search-bar-right');
var bookAppointmentForm = document.querySelector('.appointment-form');

// Add an event listener to the book appointment button
bookAppointmentButton.addEventListener('click', function() {
    // Hide the doctor card and search bar
    doctorCard.style.display = 'none';
    searchBar.style.display = 'none';

    // Show the Book Appointment form
    bookAppointmentForm.style.display = 'block';
});

