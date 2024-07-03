<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search input
$product_name = $_GET['product_name'];

// Vulnerable SQL query
$sql = "SELECT * FROM products WHERE product_name LIKE '%$product_name%'";

$result = $conn->query($sql);


// ================================================================================================
// ================================================================================================
// ================================================================================================
// ================================================================================================

if ($result->num_rows > 0) {
    echo "<h3>Search Results:</h3>";
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["product_name"] . " - $" . $row["price"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No products found.";
}

$conn->close();
?>
