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
    $email = $_POST['email'];
    $password = $_POST['psw'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("s", $email);

    // Execute the query
    $stmt->execute();
    $stmt->store_result();

    // Check if email exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            echo "Login successful!";
            // Redirect or start session here
            session_start();
            $result = mysqli_query($conn,"SELECT id, role FROM users WHERE email='$email'");
            $data = mysqli_fetch_array($result);
            $_SESSION["account_id"] = $data['id'];
            $_SESSION["role_descriptor"] = $data['role'];
            header('Location: index.php');
        } else {
            echo "Incorrect email or password.";
        }
    } else {
        echo "Incorrect email or password.";
    }

    // Close statement and connection
    $stmt->close();
}

mysqli_close($conn);
