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

// Check if form is submitted for user update
$update_success = false;
if (isset($_POST['update'])) {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $update_sql = "UPDATE users SET name='$name', role='$role' WHERE matric='$matric'";
    if ($mysqli->query($update_sql)) {
        $update_success = true;
    } else {
        echo "Error updating record: " . $mysqli->error;
    }
}

// Get user data based on the matric number
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $sql = "SELECT matric, name, role FROM users WHERE matric='$matric'";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    $mysqli->close();
} else {
    die('Matric number is not provided.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>
    <style>
    .form {
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }
    .form div {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .form label {
        width: 100px;
        margin-right: 10px;
        text-align: right;
    }
    .form input, .form select {
        flex: 1;
        padding: 5px;
    }
    h1 {
        text-align: center;
    }
    .form input[type="submit"] {
        width: 100%;
        background-color: blue;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px;
        cursor: pointer;
        text-align: center;
    }
    .form input[type="submit"]:hover {
        background-color: darkblue;
    }
        .message {
            text-align: center;
            color: green;
            font-size: large;
            font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', 'sans-serif';
            margin: 20px 0;
        }
</style>
</head>
<body>
    
    <div class="form">
    <h1>Update User</h1>
        
    <?php if ($update_success): ?>
        <div class="message">Record updated successfully</div>
    <?php endif; ?>
    <form method="post" action="">
        
        <input type="hidden" name="matric" value="<?php echo $user['matric']; ?>" />
        
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>" required />
        </div>
        
        <div>
            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="Student" <?php if ($user['role'] == 'Student') echo 'selected'; ?>>Student</option>
                <option value="Lecturer" <?php if ($user['role'] == 'Lecturer') echo 'selected'; ?>>Lecturer</option>
            </select>
        </div>
        
        <div>
            <input type="submit" name="update" value="Update"/>
        </div>
        
         <p style="text-align:center"><a href='index.php'>Back To User List</a></p>
    </form>
   </div>
</body>
</html>
