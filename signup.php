<!--Written by Louie Heintzman and Jakob Syvertsen-->
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "Group2CCSCC202$";
$dbname = "techinspection";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values
    $firstName = mysqli_real_escape_string($conn,$_POST['fname']);
    $lastName = mysqli_real_escape_string($conn,$_POST['lname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['psw']);

    // Check if email is already in use
    $sql = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $stmt = mysqli_fetch_array($result);

    if ( $stmt != NULL && count($stmt) > 0) {
        echo "Email is already in use.";
    } else {
        // Password requirements check
        if (strlen($password) >= 8 && preg_match('/[0-9]/', $password) && preg_match('/[@!#$%^&+=]/', $password)) {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);


            $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$firstName', '$lastName', '$email', '$hashed_password')";
            // Execute the query
            if(mysqli_query($conn, $sql)){
                echo "data stored in a database successfully." 
                    . " Please browse your localhost php my admin" 
                    . " to view the updated data</h3>";

                    //Create a driver account when new account is created
                    $sql = "SELECT id FROM users WHERE email='$email'";
                    $result = mysqli_query($conn, $sql);
                    $stmt = mysqli_fetch_array($result);
                    $account_id = $stmt["id"];

                    $sql = "INSERT INTO driver_table SET account_id = (SELECT id FROM users WHERE id='$account_id')";
                    mysqli_query($conn, $sql);
                header('Location: login.html');
            } else{
                echo "ERROR: Hush! Sorry $sql. " 
                    . mysqli_error($conn);
            }
        } else {
            echo "Password does not meet requirements.";
        }
    }

}

// Close connection
mysqli_close($conn);
