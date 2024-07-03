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

// Get the form input
$user = $_POST['username'];
$pass = $_POST['password'];

// Secure SQL query using prepared statements
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();

$result = $stmt->get_result();



// ================================================================================================
// ================================================================================================
// ================================================================================================
// ================================================================================================


if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Welcome, " . $row["username"] . "!<br>";
    }
} else {
    echo "Invalid username or password.";
}

$stmt->close();
$conn->close();
?>
