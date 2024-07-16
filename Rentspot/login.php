<?php
session_start();
include "connection.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';

if (isset($_SESSION['email'])) {
    header("Location: home.php");
    exit();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $data = mysqli_fetch_array($query);

        if ($data && password_verify($password, $data['password'])) {
            $_SESSION['email'] = $email;

            $otp = rand(100000, 999999);
            $otp_expiry = date("Y-m-d H:i:s", strtotime("+3 minutes"));
            $subject = "Your OTP for Login";
            $message = "Your OTP is: $otp";

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'sunnymanobharath@gmail.com'; // host email 
                $mail->Password = 'lkex nhcc mlsg nxan'; // app password of your host email
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->isHTML(true);
                $mail->setFrom('example@gmail.com', 'RentSpot'); // Sender's Email & Name
                $mail->addAddress($email); // Receiver's Email
                $mail->Subject = $subject;
                $mail->Body = $message;
                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                exit();
            }

            $sql1 = "UPDATE users SET otp='$otp', otp_expiry='$otp_expiry' WHERE id=" . $data['id'];
            $query1 = mysqli_query($conn, $sql1);

            if ($query1) {
                $_SESSION['temp_user'] = ['id' => $data['id'], 'otp' => $otp];
                header("Location: otp_verification.php");
                exit();
            } else {
                echo "Failed to update OTP. Please try again.";
            }
        } else {
            echo '<script>
                alert("Invalid Email or Password. Please try again.");
                window.location.href = "login.html";
            </script>';
        }
    } else {
        echo 'Query Error: ' . mysqli_error($conn);
    }
}

if (isset($_POST['signup'])) {
    $semail = $_POST['semail'];
    $spassword = $_POST['spassword'];
    $hashed_password = password_hash($spassword, PASSWORD_DEFAULT);

    $semail = mysqli_real_escape_string($conn, $semail);

    $stmt = mysqli_prepare($conn, "INSERT INTO users (`email`, `password`) VALUES (?, ?)");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $semail, $hashed_password);
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            header("Location: home.php");
            exit();
        } else {
            echo "<script>alert('Registration failed. Please try again.'); window.location.href = 'signup.html';</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo 'Prepare Error: ' . mysqli_error($conn);
    }
}
?>
