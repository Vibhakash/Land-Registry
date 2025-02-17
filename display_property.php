<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Listings</title>
    <link rel="stylesheet" href="display_prop.css">
</head>
<body>
    <div class="container">
        <h2>Property Listings</h2>

        <?php
        session_start();

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'landregistry');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch all properties
        $sql = "SELECT * FROM properties";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($property = $result->fetch_assoc()) {
                echo "<div class='property-details'>";
                echo "<h3>Property Details</h3>";
                echo "<p><strong>State:</strong> " . htmlspecialchars($property['state']) . "</p>";
                echo "<p><strong>District:</strong> " . htmlspecialchars($property['district']) . "</p>";
                echo "<p><strong>City:</strong> " . htmlspecialchars($property['city']) . "</p>";
                echo "<p><strong>Market Value:</strong>  " . htmlspecialchars($property['market_value']) . "Rs</p>";
                echo "<p><strong>Survey Number:</strong> " . htmlspecialchars($property['survey_number']) . "</p>";
                echo "<p><strong>Size:</strong> " . htmlspecialchars($property['size']) . " sq ft</p>";

                // Display availability and provide clickable links
                if ($property['mark_available'] == 1) {
                    echo "<a href='mark_available.php?survey_number=" . urlencode($property['survey_number']) . "&status=0'>";
                    echo "<div class='availability-box available'>Land is Available</div>";
                    echo "</a>";
                } else {
                    echo "<a href='mark_available.php?survey_number=" . urlencode($property['survey_number']) . "&status=1'>";
                    echo "<div class='availability-box not-available'>Land is Not Available</div>";
                    echo "</a>";
                    // Link to mark as available
                }

                echo "</div>";
                echo "<hr>";
            }
        } else {
            echo "<p>No properties found.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
