<?php
// Function to send email notification
function sendEmailNotification($recipient, $subject, $message) {
    // You may need to configure your server's mail settings for this to work
    $headers = "From: your_email@example.com"; // Replace with your email address
    mail($recipient, $subject, $message, $headers);
}

// Example usage
$recipientEmail = "customer@example.com"; // Replace with the customer's email address
$notificationSubject = "Water Usage Notification";
$notificationMessage = "Dear customer, your water usage for the current billing cycle is available. Please log in to view your latest statement.";

// Send email notification
sendEmailNotification($recipientEmail, $notificationSubject, $notificationMessage);
?>
