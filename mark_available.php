<?php
session_start();

// Check if survey_number and status are passed in the URL
if (isset($_GET['survey_number']) && isset($_GET['status'])) {
    $surveyNumber = $_GET['survey_number'];
    $newStatus = (int)$_GET['status']; // Cast status to integer (either 0 or 1)

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'landregistry');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the property to mark it as available or not available
    $stmt = $conn->prepare("UPDATE properties SET mark_available = ? WHERE survey_number = ?");
    $stmt->bind_param("is", $newStatus, $surveyNumber);

    if ($stmt->execute()) {
        // Redirect back to display properties page
        header("Location: display_property.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
