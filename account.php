<!--Written by Jakob Syvertsen-->
<?php

    //session information
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "Group2CCSCC202$";
    $dbname = "techinspection";
    $con = mysqli_connect($servername, $username, $password, $dbname);

    $account_id = $_GET['id'];

    //get driver info
    $result = mysqli_query($con,"SELECT helmet_status, inspection_date, helmetimg, novice_driver, driver_id FROM driver_table WHERE account_id='$account_id'");
    $data = mysqli_fetch_array($result);

    //check if driver account is made, if not make one
    //this is for if an account is somehow made without
    //going through signup.php
    if (mysqli_num_rows($result)==0): {
        $sql = "INSERT INTO driver_table SET account_id = (SELECT id FROM users WHERE id='$account_id')";
        mysqli_query($con, $sql);
    }endif;

    //get account info
    $account_result = mysqli_query($con,"SELECT first_name, last_name, email, role FROM users WHERE id='$account_id'");
    $account_data = mysqli_fetch_array($account_result);
    
    //set form data to info from DB
    $helmet = !isset($data['helmet_status']) ? 'False' : $data['helmet_status'];
    $novice = !isset($data['novice_driver']) ? 'False' : $data['novice_driver'];
    $inspection = !isset($data['inspection_date']) ? NULL : $data['inspection_date'];
    $helmetimg = !isset($data['helmetimg']) ? NULL : $data['helmetimg'];

        $cars = "SELECT * FROM garage_table WHERE car_owner_id=(SELECT driver_id FROM driver_table WHERE account_id='$account_id')";
        $garage_selector = mysqli_query($con,$cars);

?>


<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible"content="IE=edge">
<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>"></link>
</head>

<body>
<div class="page-wrapper">
<header class="header-wrapper">
  <a href="index.php" class="header-link">Menu</a>
  <a href="techform.php" class="header-link">Tech Inspection Form</a>
  <a href="account.php?id=<?php echo $_SESSION["account_id"]; ?>" class="header-link" style="margin-left: auto;">Account</a>
  <a href="login.html" class="header-link">Logout</a>
</header>

<h3><?php echo $account_data['first_name'] . " " . $account_data['last_name']; ?></h3>
<h4><?php echo $account_data['role']; ?></h4>
<h4><?php echo $account_data['email']; ?></h4>

<div class="form-wrapper">
<form action="driver.php?id=<?php echo $data['driver_id']; ?>" method="POST" enctype="multipart/form-data">
<fieldset class="wrapper" style="border: 0;">

    <div class="container-div">
    <label for="options" class="yes-no-labels">Yes  No</label><br>
    <input type="radio" id="helmet1" name="helmet" value="True" <?php echo ($helmet == 'True') ? 'checked' : ''; ?> required>
    <input type="radio" id="helmet2" name="helmet" value="False" <?php echo ($helmet == 'False') ? 'checked' : ''; ?> required>
    <label for="helmet">Yearly Helmet Inspection?</label><br>

    <input type="radio" id="novice1" name="novice" value="True" <?php echo ($novice == 'True') ? 'checked' : ''; ?> required>
    <input type="radio" id="novice2" name="novice" value="False" <?php echo ($novice == 'False') ? 'checked' : ''; ?> required>
    <label for="helmet">Novice Driver?</label><br>

    <label for="inspectdate">Last Date of Inspection:</label>
    <input type="date" id="inspectdate" name="inspectdate" value="<?php echo (isset($inspection)) ? $inspection : date('Y-m-d'); ?>" /><br>
    <?php if (date("Y-m-d", strtotime('-1 year')) > $inspection): ?>
        <p>Your helmet needs to be inspected!</p>
    <?php endif; ?>

    <label for="helmetimg">Image of Helmet:</label>
    <input type="file" id="helmetimg" name="helmetimg" accept="image/*"><br>
    <img src="<?php echo $helmetimg; ?>" class="img-wrapper">

    <div class="submit-wrapper">
    <input type="submit" value="Submit" name="submit" id="submit">
    </div>
    </div>
</fieldset>
</form>   
</div> 

<div class="form-wrapper">

<div>
    <h3>Garage</h3>

    <select name="garageselector">
            <?php
                while ($garage = mysqli_fetch_array($garage_selector, MYSQLI_ASSOC)):;
            ?>
                <option value="<?php echo $garage["car_id"]; ?>">
                    
                    <?php echo $garage["car_year"] . " " . $garage["car_make"] . " " . $garage["car_model"] . ", " . $garage["car_class"] . ", " . $garage["car_color"]; ?>
                </option>
            <?php
                endwhile;
            ?>
    </select>
</div>

<form action="garage.php?id=<?php echo $data['driver_id']; ?>" method="POST">
    <fieldset class="wrapper" style="border: 0;">
    <div style="container-div">
        
    <h3>Add a new car to your garage:</h3>
    
    <label for="caryear">Car Year:</label>
    <input type="text" id="caryear" name="caryear" required>

    <label for="carmake">Car Make:</label>
    <input type="text" id="carmake" name="carmake" required>

    <label for="carmodel">Car Model:</label>
    <input type="text" id="carmodel" name="carmodel" required>

    <label for="carclass">Car Class:</label>
    <input type="text" id="carclass" name="carclass" required>

    <label for="carcolor">Car Color:</label>
    <input type="text" id="carcolor" name="carcolor" required>

    <div class="submit-wrapper">
    <input type="submit" value="Submit" name="submit" id="submit">
    </div>
    </div>
    </fieldset>
</form>

</div>

<div></div>
</div>



</body>
</html>
<?php
    mysqli_close($con);
?>