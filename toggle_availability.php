<?php
session_start();

$propertyId = $_POST['property_id'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'landregistry');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// First, get the current status of the property
$sql = "SELECT mark_available FROM properties WHERE property_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $propertyId);
$stmt->execute();
$result = $stmt->get_result();
$property = $result->fetch_assoc();

// Toggle the availability
$newStatus = $property['mark_available'] == 1 ? 0 : 1;

// Update the property status
$stmt = $conn->prepare("UPDATE properties SET mark_available = ? WHERE property_id = ?");
$stmt->bind_param("is", $newStatus, $propertyId);
$stmt->execute();

header("Location: customer_results.php");
exit();
?>
