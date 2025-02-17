<?php
session_start();

$propertyId = $_POST['property_id'];

$conn = new mysqli('localhost', 'root', '', 'landregistry');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Thank you for your interest! Your request has been noted.<br>";
echo '<a href="customer_search.php">Back to Search</a>';

$conn->close();
?>
