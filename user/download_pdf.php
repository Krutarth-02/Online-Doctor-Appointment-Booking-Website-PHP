<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "healthcare");

$appointment = $_GET['appointment_id'];
// Get the appointment details from the database
$query = "SELECT * FROM appointment WHERE appointment_id = '$appointment'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

// Create a PDF document
require_once('tcpdf/tcpdf.php');
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set the PDF document properties
$pdf->SetTitle('Appointment Details');
$pdf->SetAuthor('Healthcare System');
$pdf->SetSubject('Appointment Details');

// Add a page to the PDF document
$pdf->AddPage();

$imageWidth = 50;
$imageHeight = 50;

$x = ($pdf->getPageWidth() - $imageWidth) / 2;
$y = ($pdf->getPageHeight() - $imageHeight) / 2;
// Add the image to the PDF document
// $pdf->Image('img/appointment.png', $x, $y, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0);
// Set the font and font size for the PDF document
$pdf->SetFont('Helvetica', '', 12);

// Add the appointment details to the PDF document

$pdf->Cell(0, 10, 'Full Name: ' . $row['fullname'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Doctor Fullname: ' . $row['doctor_fullname'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Gender: ' . $row['gender'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Age: ' . $row['age'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Disease: ' . $row['disease'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Appointment Date: ' . $row['appointment_date'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Appointment Time: ' . $row['appointment_time'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Address: ' . $row['address'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Contact Number: ' . $row['contact_number'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Reamrk: ' . $row['remark'], 0, 1, 'L');

// Output the PDF document
$pdf->Output('appointment_details.pdf', 'D');?>