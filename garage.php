<!--Written by Jakob Syvertsen-->
<?php

//Session info
session_start();

$servername = "localhost";
$username = "root";
$password = "Group2CCSCC202$";
$dbname = "techinspection";

// Create connection
$conn = new mysqli($servername, 
    $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " 
        . $conn->connect_error);
}

//Set and sanitise car info
$caryear = mysqli_real_escape_string($conn,$_REQUEST['caryear']);
$carmake = mysqli_real_escape_string($conn,$_REQUEST['carmake']);
$carmodel = mysqli_real_escape_string($conn,$_REQUEST['carmodel']);
$carclass = mysqli_real_escape_string($conn,$_REQUEST['carclass']);
$carcolor = mysqli_real_escape_string($conn,$_REQUEST['carcolor']);
$ownerid = $_GET['id'];

//insert info into DB
$sql = "INSERT INTO garage_table (car_year,car_make,car_model,car_class,car_color,car_owner_id) VALUES ('$caryear','$carmake','$carmodel','$carclass','$carcolor','$ownerid')";

if(mysqli_query($conn, $sql)){
    echo "data stored in a database successfully." 
        . " Please browse your localhost php my admin" 
        . " to view the updated data</h3>";
    header('Location: index.php');
} else{
    echo "ERROR: Hush! Sorry $sql. " 
        . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
