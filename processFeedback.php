<?php
require('connect_db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $fullName = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contactNumber = trim($_POST['phone']);
    $message = trim($_POST['comments']);
    $submittedDate = date("Y-m-d H:i:s");
    // Prepare SQL statement
    $sql = "INSERT INTO feedback (fullName, email, contactNumber, message) 
            VALUES (?, ?, ?, ?)";

    // Prepare and bind
    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("ssss", $fullName, $email, $contactNumber, $message);

        // Execute and check success
        if ($stmt->execute()) {
            echo "<script>alert('Thank you for your feedback!'); window.location.href='contactPage.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $link->error;
    }

    $link->close();
} else {
    header("Location: contactPage.php"); // Redirect if accessed without POST
    exit();
}
?>