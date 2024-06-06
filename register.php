<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
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
    .message {
        text-align: center;
        margin: 10px 0;
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
</style>
</head>
<body>
<?php
require('db.php');
// If form submitted, insert values into the database.
if (isset($_POST['matric'])){
        // removes backslashes
    $matric = stripslashes($_POST['matric']);
        //escapes special characters in a string
    $matric = mysqli_real_escape_string($con, $matric);
    $name = stripslashes($_POST['name']);
    $name = mysqli_real_escape_string($con, $name);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $role = stripslashes($_POST['role']);
    $role = mysqli_real_escape_string($con, $role);
    $query = "INSERT INTO `users` (matric, name, password, role)
              VALUES ('$matric', '$name',  '".md5($password)."', '$role')";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo "<div class='form'>
                <h3>You are registered successfully.</h3>
                <br/>Click here to <a href='login.php'>Login</a>
              </div>";
    } else {
        echo "<div class='form'>
                <h3>Registration failed. Please try again.</h3>
              </div>";
    }
} else {
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
    <div>
        <label for="matric">Matric:</label>
        <input type="text" name="matric" id="matric" placeholder="Matric" required />
    </div>
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Name" required />
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Password" required />
    </div>
    <div>
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option selected disabled>--Select Role--</option>
            <option value="Student">Student</option>
            <option value="Teacher">Lecturer</option>
        </select>
    </div>
    
    <div>
        <input type="submit" name="submit" value="Register" />
    </div>
    
    <p style="text-align:center">Already have an account? <a href='login.php'>Log In</a></p>
</form>
</div>
<?php } ?>
</body>
</html>
