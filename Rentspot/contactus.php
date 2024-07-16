<?php

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
?>