<?php
// contact.php

// Set header to return JSON response
header('Content-Type: application/json');

// Initialize the response array
$response = array('success' => false, 'message' => 'An error occurred.');

// Check if request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize and assign inputs
    $name = htmlspecialchars(strip_tags(trim($_POST["name"])));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(strip_tags(trim($_POST["message"])));

    // Basic Backend Validation
    if (empty($name) || empty($email) || empty($message)) {
        $response['message'] = 'Please fill out all required fields.';
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Invalid email format.';
        echo json_encode($response);
        exit;
    }

    // Here you would typically send an email, e.g., using mail() function
    // For this assignment, we'll simulate a successful submission
    
    /* Example Mail Setup
    $to = "your-email@example.com";
    $subject = "New Contact Form Submission from $name";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email";
    
    if (mail($to, $subject, $body, $headers)) {
        $response['success'] = true;
        $response['message'] = 'Thank you! Your message has been sent.';
    } else {
        $response['message'] = 'Failed to send message. Please try again.';
    }
    */

    // Simulate success response for the form
    $response['success'] = true;
    $response['message'] = 'Thank you! Your message has been sent successfully.';
    
} else {
    // Not a POST request
    $response['message'] = 'Invalid request method.';
}

// Return JSON response to JavaScript
echo json_encode($response);
?>
