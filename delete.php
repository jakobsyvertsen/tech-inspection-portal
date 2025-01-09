<!--Written by Jakob Syvertsen-->
<?php

$servername = "localhost";
$username = "root";
$password = "Group2CCSCC202$";
$dbname = "techinspection";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " 
        . $conn->connect_error);
}


    //Get row ID, then delete that row in the form_table
    $row_id = $_POST["row_id"];
    $delete_sql = "DELETE FROM form_table WHERE form_id=$row_id";

    if(mysqli_query($conn, $delete_sql)){
        echo "row successfully deleted." 
            . " Please browse your localhost php my admin" 
            . " to view the updated data</h3>";
        header('Location: index.php');
    } else{
        echo "ERROR: Hush! Sorry $sql. " 
            . mysqli_error($conn);
    }

mysqli_close($conn);