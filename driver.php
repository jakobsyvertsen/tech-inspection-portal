<!--Written by Jakob Syvertsen-->
<?php

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


//Set driver info
$helmet = $_REQUEST['helmet'];
$novice = $_REQUEST['novice'];
$inspectdate = $_REQUEST['inspectdate'];
$driverid = $_GET['id'];

//Set and create owner directory
$target_directory = "images/owners/" . $driverid . "/";
mkdir($target_directory);

//Only pass image into DB if the image is named and has a size (verify that it exists)
if((isset($_FILES['helmetimg']['name']) && ($_FILES['helmetimg']['size'] > 0))): {
    $helmetimg = $target_directory . uniqid(). $_FILES['helmetimg']['name'];
    move_uploaded_file($_FILES['helmetimg']['tmp_name'], $helmetimg);
    }endif;

//Only update values in table if php variables are not null, see update.php for more info
$sql = "UPDATE driver_table SET helmet_status=COALESCE(NULLIF('$helmet', ''),helmet_status),inspection_date=COALESCE(NULLIF('$inspectdate', ''),inspection_date),helmetimg=COALESCE(NULLIF('$helmetimg', ''),helmetimg),novice_driver=COALESCE(NULLIF('$novice', ''),novice_driver) WHERE driver_id=$driverid;";

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
