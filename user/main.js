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

// Function to hide the appointment form
function hideForm() {
    // Hide the appointment form
    appointmentForm.style.display = 'none';

    // Show the doctor card and search bar
    document.querySelector('.doctor-card').style.display = 'block';
    document.querySelector('.search-bar-right').style.display = 'block';

    // Unblur the background content
    document.querySelector('.container').style.filter = 'none';
    document.querySelector('.container').style.pointerEvents = 'auto';
}
function showReminders() {
    // Fetch reminders using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "notification.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var reminders = JSON.parse(xhr.responseText);
            var appointmentDetails = "<div class='appointment-details-container'>";
            
            reminders.forEach(function (reminder) {
                appointmentDetails += `
                    <div class="appointment-card">
                        <img src="uploads/doctor.jpg" alt="Doctor Photo" class="doctor-photo">
                        <div class="doctor-info">
                            <h2>Dr. John Doe</h2> <!-- Replace with actual doctor name -->
                            <p><strong>Appointment Date:</strong> ${reminder.appointment_date}</p>
                            <p><strong>Appointment Time:</strong> ${reminder.appointment_time}</p>
                            <p><strong>Reminder Time:</strong> ${reminder.reminder_time}</p>
                        </div>
                    </div>
                `;
            });
            
            appointmentDetails += "</div>";
            document.querySelector(".notification-menu").innerHTML = appointmentDetails;
            document.querySelector(".notification-menu").style.display = "block"; // Show the notification menu
        }
    };
    xhr.send();
}


