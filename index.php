<?php
//include auth.php file on all secure pages
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

// SQL query to select data from database
$sql = "SELECT matric, name, role FROM users";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Details</title>
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', 'sans-serif';
        }
        td {
            background-color: #E4F5D4;
            border: 1px solid black;
        }
        th, td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        td {
            font-weight: lighter;
        }
        .container {
            height: 200px;
            position: relative;
            border: 3px solid green;
        }
        .center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        a {
            text-align: center;
        }
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-success {
            background-color: green;
            color: white;
        }
        .btn-danger {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
    <section>
        <h1>User Data</h1>
        <table>
            <tr>
                <th>Matric Number</th>
                <th>Name</th>
                <th>Role</th>
                <th colspan="2"><strong>Action</strong></th>
            </tr>
            <?php 
                while ($rows = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $rows['matric']; ?></td>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['role']; ?></td>
                <td style="cursor:pointer"><a href="update.php?matric=<?php echo $rows['matric']; ?>" class="btn btn-success">Update</a></td>
                <td style="cursor:pointer"><a href="delete.php?matric=<?php echo $rows['matric']; ?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php
                }
            ?>
        </table> <br><br>
        <h1><a href="logout.php">Logout</a></h1>
    </section>
</body>
</html>
