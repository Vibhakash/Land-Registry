<?php
session_start();

// Get search criteria
$state = $_POST['state'];
$district = $_POST['district'];
$city = $_POST['city'];
$surveyNumber = $_POST['survey_number'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'landregistry');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL query
$stmt = $conn->prepare("SELECT * FROM properties WHERE state = ? AND district = ? AND city = ? AND survey_number = ?");
$stmt->bind_param("ssss", $state, $district, $city, $surveyNumber);
$stmt->execute();
$result = $stmt->get_result();

// Start output buffering
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Properties</title>
    <link rel="stylesheet" href="cust_results.css">
</head>
<body>
    <div class="container">
        <h2>Explore Properties</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($property = $result->fetch_assoc()) {
                echo '<div class="property-card">';
                echo '<h3>Property Details</h3>';
                echo '<p><strong>Survey Number:</strong> ' . htmlspecialchars($property['survey_number']) . '</p>';
                echo '<p><strong>Property ID:</strong> ' . htmlspecialchars($property['property_id']) . '</p>';
                echo '<p><strong>Market Value:</strong> ' . htmlspecialchars($property['market_value']) . ' Rs</p>';
                echo '<p><strong>Size:</strong> ' . htmlspecialchars($property['size']) . ' sq ft</p>';

                // Display availability status in a box
                if ($property['mark_available'] == 1) {
                    echo '<div class="status-box available">Available</div>';
                } else {
                    echo '<div class="status-box not-available">Not Available</div>';
                }

                echo '</div><hr>';
            }
        } else {
            echo '<p>No properties found.</p>';
        }
        ?>
    </div>
</body>
</html>

<?php
// End output buffering and flush output
ob_end_flush();

// Close connection
$stmt->close();
$conn->close();
?>
