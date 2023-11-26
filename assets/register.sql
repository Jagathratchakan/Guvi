// Database configuration
$servername = "localhost";
$username = "root";
$password = "";

// Connect to MySQL server
$con = new mysqli($servername, $username, $password);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Create database
$sql = "CREATE DATABASE register";
if ($con->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $con->error;
}

// Select database
mysqli_select_db($con, "register");

// Create table
$sql = "CREATE TABLE register (
        Name VARCHAR(30) NOT NULL,
        Email VARCHAR(50) NOT NULL,
        Password VARCHAR(255) NOT NULL,
  PrivateKey VARCHAR(30) NOT NULL,

    )";
if ($con->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close connection
$conn->close();
