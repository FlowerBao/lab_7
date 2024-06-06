<?php
include("auth.php");

// Database connection details
$user = 'root';
$password = '';
$database = 'lab_7';
$servername = 'localhost';
$mysqli = new mysqli($servername, $user, $password, $database);

// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Check if matric is set
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    // Delete user based on matric number
    $delete_sql = "DELETE FROM users WHERE matric='$matric'";
    if ($mysqli->query($delete_sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }
    $mysqli->close();
} else {
    die('Matric number is not provided.');
}

// Redirect to the main page
header("Location: index.php");
exit;
?>
