<?php
session_start();

// Enable error reporting for debugging
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$conn = new mysqli('localhost', 'root', '', 'landregistry');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $state = $_POST['state'];
    $district = $_POST['district'];
    $city = $_POST['city'];
    $propertyId = $_POST['propertyId'];
    $surveyNumber = $_POST['surveyNumber'];
    $marketValue = $_POST['marketValue'];
    $size = $_POST['size'];
    $markAvailable=1;
    // Database connection

    // Check connection
    

    // Insert property data into the database
    $stmt = $conn->prepare("INSERT INTO properties (state, district, city, property_id, survey_number, market_value, size,mark_available) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $state, $district, $city, $propertyId, $surveyNumber, $marketValue, $size,$markAvailable);

    if ($stmt->execute()) {
        // Redirect to display property screen
        header("Location: display_property.php");
        exit(); // Stop further execution
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>