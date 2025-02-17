<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'landregistry');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user details from the form
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password']; // Hash the password for security
$role = $_POST['role'];

// Prepare SQL statement to insert user into the database
$stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $fullname, $email, $password, $role);

if ($stmt->execute()) {
    // Redirect based on role
    if ($role == "owner") {
        header("Location: land_registration.html");
    } elseif ($role == "customer") {
        header("Location: customer_search.html");
    }
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
