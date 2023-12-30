<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'path/to/PHPMailerAutoload.php'; // Replace with the actual path to PHPMailerAutoload.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Basic form field validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Please fill in all required fields.";
        // You might want to redirect back to the form or show an error message
        exit();
    }

    // Instantiate PHPMailer
    $mail = new PHPMailer;
    
    // Enable debugging (remove in production)
    $mail->SMTPDebug = 2;

    // Set the mailer to use SMTP
    $mail->isSMTP();

    // Set SMTP server details
    $mail->Host = 'your_smtp_server';
    $mail->SMTPAuth = true;
    $mail->Username = 'your_smtp_username';
    $mail->Password = 'your_smtp_password';
    $mail->SMTPSecure = 'tls'; // or 'ssl' if required
    $mail->Port = 587; // or the port required by your SMTP server

    // Set sender and recipient
    $mail->setFrom($email, $name);
    $mail->addAddress('mshanuga2000@gmail.com'); // Replace with your email

    // Set email content
    $mail->Subject = $subject;
    $mail->Body = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";

    // Attempt to send the email
    if ($mail->send()) {
        echo "Message sent successfully!";
        header("Location: thank_you.html");
        exit();
    } else {
        echo "Message delivery failed. Please try again later.";
        // Uncomment the line below for debugging purposes
         echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>
