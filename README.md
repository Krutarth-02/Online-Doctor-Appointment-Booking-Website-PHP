# Online Doctor Appointment Booking System

This is a web-based application for booking doctor appointments online. The system allows patients to register, log in, search for doctors, and book appointments. It also provides an admin panel for managing doctors, appointments, and patient records.

## Features

- **Patient Registration and Login**: Patients can create an account and log in to book appointments.
- **Doctor Search**: Patients can search for doctors based on specialization, availability, and location.
- **Appointment Booking**: Patients can book, reschedule, or cancel appointments.
- **Admin Panel**: Admins can manage doctors, view appointments, and handle patient records.
- **Responsive Design**: The website is mobile-friendly and works on all devices.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Server**: XAMPP (Apache, MySQL)

## Prerequisites

Before running the project, ensure you have the following installed:

1. **XAMPP**: Download and install XAMPP from [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).
2. **Web Browser**: Any modern web browser like Chrome, Firefox, or Edge.
3. **Text Editor**: Use a text editor like VS Code, Sublime Text, or Notepad++ for editing code.

## Setup Instructions

Follow these steps to set up the project on your local machine using XAMPP:

1. **Download the Project**:
   - Clone this repository or download the ZIP file and extract it.

2. **Move the Project to XAMPP Directory**:
   - Copy the project folder and rename it to `code`.
   - Paste the `code` folder into the `htdocs` directory inside your XAMPP installation folder (e.g., `C:\xampp\htdocs`).

3. **Start XAMPP**:
   - Open the XAMPP Control Panel and start the `Apache` and `MySQL` services.

4. **Create a Database**:
   - Open your browser and go to `http://localhost/phpmyadmin`.
   - Click on `New` in the left sidebar to create a new database.
   - Name the database `healthcare` and click `Create`.

5. **Import the SQL File**:
   - After creating the database, click on the `healthcare` database in the left sidebar.
   - Go to the `Import` tab at the top.
   - Click `Choose File` and select the `healthcare.sql` file from the `sql` folder in your project directory.
   - Click `Go` to import the SQL file into the database.

6. **Configure Database Connection**:
       ```php
     $host = "localhost";
     $username = "root"; // Default XAMPP username
     $password = ""; // Default XAMPP password
     $database = "healthcare"; // Your database name
     ```

7. **Run the Project**:
   - Open your browser and navigate to `http://localhost/code/`.

8. **Admin Access**:
   - To access the admin panel, go to `http://localhost/code/admin`.
   - Use the following credentials to log in:
     - **Username**: `admin`
     - **Password**: `admin`
       
## Contributing

Contributions are welcome! If you'd like to contribute, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Commit your changes.
4. Push your branch and submit a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

For any questions or feedback, feel free to reach out:

- **Email**: krutarthkhadodiya2@gmail.com
- **GitHub**: [Krutarth-02](https://github.com/Krutarth-02)
