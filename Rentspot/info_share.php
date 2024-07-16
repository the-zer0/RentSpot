<?php
include "connection.php";
session_start();
// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}
$email = $_GET['email'];
$phone_number = $_GET['phone_number'];
$product_id = $_GET['product_id'];
$product_name = $_GET['product_name'];
$category = $_GET['category'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$amount = $_GET['amount'];
$description = $_GET['description'];
// $date_of_upload = $_GET['date_of_upload'];
$image = $_GET['image'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';

// Create a PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'sunnymanobharath@gmail.com'; // Your Gmail address
    $mail->Password   = 'lkex nhcc mlsg nxan'; // Your Gmail password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Sender and recipient
    $mail->setFrom('your@gmail.com', 'RentSpot');
    $mail->addAddress($_SESSION['email']);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'RentSot | Details of the vendor!! ';
    $mail->Body    = '<h3>Contact Details</h3><br>
                      Product Name: ' . $product_name . '<br>
                      Phone Number: ' . $phone_number . '<br>
                      Mail Id: ' . $email;

    // Send the email
    $mail->send();
    echo 'Email has been sent successfully.';
} catch (Exception $e) {
    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
}


$sql1 = "INSERT INTO userbuying (email, phone_number, product_name, category, from_date, to_date, amount, description, image, taker_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("ssssssssss", $email, $phone_number, $product_name, $category, $from_date, $to_date, $amount, $description, $image, $_SESSION['email']);
if($stmt1->execute()) {
    // echo "<alert>Record inserted successfully</alert>";
} else {
    echo "Error: " . $stmt1->error;
}
$stmt1->close();
?>
