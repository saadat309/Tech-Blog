<?php
// Turn off error display but log errors to a file
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log'); // Ensure this path is writable by the web server
error_reporting(E_ALL);

// Database connection details
$server = "localhost";
$username = "root";
$password = "";
$dbname = "form";
$table = "feedback";

// Create a connection to the database
$conn = mysqli_connect($server, $username, $password, $dbname);

// Check connection
if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error()); // Log database connection errors
    echo "There was a problem connecting to the database.";
    exit();
}


// Collect POST data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Get current date and time in Pakistani Standard Time (PST)
$date = new DateTime('now', new DateTimeZone('Asia/Karachi'));
$formatted_date = $date->format('Y-m-d H:i:s');

// Prepare SQL query
$sql = "INSERT INTO $table (`name`, `email`, `message`, `date`) VALUES (?, ?, ?, current_timestamp())";

// Check SQL query preparation
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $message);
    if (mysqli_stmt_execute($stmt)) {
        echo "Your message has been sent successfully..!";
    } else {
        error_log("SQL Execution Error: " . mysqli_stmt_error($stmt)); // Log SQL execution errors
        echo "An error occurred while processing your request. Please try again later.";
    }
    mysqli_stmt_close($stmt);
} else {
    error_log("SQL Preparation Error: " . mysqli_error($conn)); // Log SQL preparation errors
    echo "An error occurred while processing your request. Please try again later.";
}


mysqli_close($conn);



    


?>
