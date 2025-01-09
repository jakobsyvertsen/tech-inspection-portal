<!--Written by Jakob Syvertsen-->
<?php

    //Connection information
    session_start();
    
    $servername = "localhost";
    $username = "root";
    $password = "Group2CCSCC202$";
    $dbname = "techinspection";
    $con = mysqli_connect($servername, $username, $password, $dbname);
    
    //set account_id for easier calling
    $account_id = $_SESSION["account_id"];


    //display all cars if not an Owner, or only the cars owned by owner
    if ($_SESSION['role_descriptor'] == 'Owner') {
        $cars = "SELECT * FROM garage_table WHERE car_owner_id=(SELECT driver_id FROM driver_table WHERE account_id='$account_id')";
    }
    else{
        $cars = "SELECT * FROM garage_table";
    }
    $garage_selector = mysqli_query($con,$cars);

    //If an ID has been passed to form, select that form from DB
    //and display it instead of a new form
    if (isset($_GET['id'])) {
        $form_id = $_GET['id'];
        $sql = "SELECT * FROM form_table WHERE form_id=$form_id";
        $result = mysqli_query($con,$sql);
        $data = mysqli_fetch_array($result);

        $form_id = $data['form_id'];
        $account_id = $data['account_id'];
        $car_id = $data['car_id'];
        $annualinspect = $data['annualinspect'];
        $form_date = $data['form_date'];
        $wheelbearings = $data['wheelbearings'];
        $wheelbearingsnotes = $data['wheelbearingsnotes'];
        $wheelbearingsimg = $data['wheelbearingsimg'];
        $wheelcheck = $data['wheelcheck'];
        $wheelchecknotes = $data['wheelchecknotes'];
        $wheelcheckimg = $data['wheelcheckimg'];
        $hubcaps = $data['hubcaps'];
        $hubcapsnotes = $data['hubcapsnotes'];
        $hubcapsimg = $data['hubcapsimg'];
        $tirecheck = $data['tirecheck'];
        $tirechecknotes = $data['tirechecknotes'];
        $tirecheckimg = $data['tirecheckimg'];
        $tiretreads = $data['tiretreads'];
        $tiretreadsnotes = $data['tiretreadsnotes'];
        $tiretreadsimg = $data['tiretreadsimg'];
        $brakecheck = $data['brakecheck'];
        $brakechecknotes = $data['brakechecknotes'];
        $brakecheckimg = $data['brakecheckimg'];
        $bodypanels = $data['bodypanels'];
        $bodypanelsnotes = $data['bodypanelsnotes'];
        $bodypanelsimg = $data['bodypanelsimg'];
        $numbers = $data['numbers'];
        $numbersnotes = $data['numbersnotes'];
        $numbersimg = $data['numbersimg'];
        $exteriorimg = $data['exteriorimg'];
        $floormats = $data['floormats'];
        $floormatsnotes = $data['floormatsnotes'];
        $floormatsimg = $data['floormatsimg'];
        $pedalscheck = $data['pedalscheck'];
        $pedalschecknotes = $data['pedalschecknotes'];
        $pedalscheckimg = $data['pedalscheckimg'];
        $brakepedal = $data['brakepedal'];
        $brakepedalnotes = $data['brakepedalnotes'];
        $brakepedalimg = $data['brakepedalimg'];
        $steering = $data['steering'];
        $steeringnotes = $data['steeringnotes'];
        $steeringimg = $data['steeringimg'];
        $gearselector = $data['gearselector'];
        $gearselectornotes = $data['gearselectornotes'];
        $gearselectorimg = $data['gearselectorimg'];
        $seat = $data['seat'];
        $seatnotes = $data['seatnotes'];
        $seatimg = $data['seatimg'];
        $seatbelt = $data['seatbelt'];
        $seatbeltnotes = $data['seatbeltnotes'];
        $seatbeltimg = $data['seatbeltimg'];
        $camerascheck = $data['camerascheck'];
        $cameraschecknotes = $data['cameraschecknotes'];
        $camerascheckimg = $data['camerascheckimg'];
        $interiorimg = $data['interiorimg'];
        $battery = $data['battery'];
        $batterynotes = $data['batterynotes'];
        $batteryimg = $data['batteryimg'];
        $airintake = $data['airintake'];
        $airintakenotes = $data['airintakenotes'];
        $airintakeimg = $data['airintakeimg'];
        $throttlecable = $data['throttlecable'];
        $throttlecablenotes = $data['throttlecablenotes'];
        $throttlecableimg = $data['throttlecableimg'];
        $fluidcaps = $data['fluidcaps'];
        $fluidcapsnotes = $data['fluidcapsnotes'];
        $fluidcapsimg = $data['fluidcapsimg'];
        $leakcheck = $data['leakcheck'];
        $leakchecknotes = $data['leakchecknotes'];
        $leakcheckimg = $data['leakcheckimg'];
        $trunk = $data['trunk'];
        $trunknotes = $data['trunknotes'];
        $trunkimg = $data['trunkimg'];
        $exhaust = $data['exhaust'];
        $exhaustnotes = $data['exhaustnotes'];
        $exhaustimg = $data['exhaustimg'];
        $hoodimg = $data['hoodimg'];
        $extranotes = $data['extranotes'];
        $notesimg = $data['notesimg'];
        $inspectinitials = $data['inspectinitials'];
        $signature_pad = $data['signature_pad'];

        //set target image directory to the form's directory.
        $target_directory = "images/" . $form_id . "/";

        //select the radio values specifically so we can make sure that
        //radios checked "no" display their notes and images
        $radio_sql = "SELECT wheelbearings, wheelcheck, hubcaps, tirecheck, tiretreads, brakecheck, bodypanels, numbers, floormats, pedalscheck, brakepedal, steering, gearselector, seat, seatbelt, camerascheck, battery, airintake, throttlecable, fluidcaps, leakcheck, trunk, exhaust FROM form_table WHERE form_id=$form_id";
        $radio_result = mysqli_query($con,$sql);
        $radio_form = $radio_result->fetch_assoc();

        $radio_list = [
            'wheelbearings' => $radio_form['wheelbearings'],
            'wheelcheck' => $radio_form['wheelcheck'],
            'hubcaps' => $radio_form['hubcaps'],
            'tirecheck' => $radio_form['tirecheck'],
            'tiretreads' => $radio_form['tiretreads'],
            'brakecheck' => $radio_form['brakecheck'],
            'bodypanels' => $radio_form['bodypanels'],
            'numbers' => $radio_form['numbers'],
            'floormats' => $radio_form['floormats'],
            'pedalscheck' => $radio_form['pedalscheck'],
            'brakepedal' => $radio_form['brakepedal'],
            'steering' => $radio_form['steering'],
            'gearselector' => $radio_form['gearselector'],
            'seat' => $radio_form['seat'],
            'seatbelt' => $radio_form['seatbelt'],
            'camerascheck' => $radio_form['camerascheck'],
            'battery' => $radio_form['battery'],
            'airintake' => $radio_form['airintake'],
            'throttlecable' => $radio_form['throttlecable'],
            'fluidcaps' => $radio_form['fluidcaps'],
            'leakcheck' => $radio_form['leakcheck'],
            'trunk' => $radio_form['trunk'],
            'exhaust' => $radio_form['exhaust']
        ];

        
        //SQL for driver info
        $driversql = "SELECT helmet_status, inspection_date, helmetimg, novice_driver FROM driver_table WHERE account_id='$account_id'";
        $driverresult = mysqli_query($con,$driversql);
        $driverdata = mysqli_fetch_array($driverresult);

        $helmet_status = $driverdata["helmet_status"];
        $inspection_date = $driverdata["inspection_date"];
        $helmetimg = $driverdata["helmetimg"];
        $novice_driver = $driverdata["novice_driver"];

        //SQL for account info
        $accountsql = "SELECT first_name, last_name FROM users WHERE id='$account_id'";
        $accountresult = mysqli_query($con,$accountsql);
        $accountdata = mysqli_fetch_array($accountresult);

        $first_name = $accountdata["first_name"];
        $last_name = $accountdata["last_name"];
    }
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible"content="IE=edge">
<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>"></link>

<script>
    //script that displays notes and info if the relevant radio val
    //is set to "False"
    document.addEventListener('DOMContentLoaded', (event) => {
        var radioVal = <?php echo json_encode($radio_list); ?>;
        for (var radio in radioVal) {
            var radioValue =radioVal[radio];
            var the_div = document.getElementById(radio + 'text');
            if (radioValue === "False") {
                the_div.style.display = 'block';
            }
            else {
                the_div.style.display = 'none';
            }
        }
    });
</script>

<script>
    //The function that reveals/hides notes/imgs on "no" click
    function revealFunction(divId) {
        document.getElementById(divId).style.display = "block";
        document.getElementById(divId).style.paddingBottom = "1em";
    }
    function hideFunction(divId) {
        document.getElementById(divId).style.display = "none";
    }

    
</script>

<!--SignaturePad source link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.3.4/signature_pad.js" integrity="sha512-j36pYCzm3upwGd6JGq6xpdthtxcUtSf5yQJSsgnqjAsXtFT84WH8NQy9vqkv4qTV9hK782TwuHUTSwo2hRF+/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.3.min.js"></script>

</head>
<body>

<div class="page-wrapper">

<header class="header-wrapper">
  <a href="index.php" class="header-link">Menu</a>
  <a href="techform.php" class="header-link">Tech Inspection Form</a>
  <a href="account.php?id=<?php echo $_SESSION["account_id"]; ?>" class="header-link" style="margin-left: auto;">Account</a>
  <a href="login.html" class="header-link">Logout</a>
</header>

<div>
    <h1 style="text-align: center">CCSCC Tech Inspection Checklist</h1>
</div>

    <!--PHP wrapper around the filled form code-->
    <?php if (isset($form_id)): ?>
    
    <!--PHP to set the entire form to readonly if it has been longer than a day since it was made, and the
        person viewing the form is NOT an Admin-->
    <?php if (date("Y-m-d H:i:s", strtotime('-1 day')) > $form_date && $_SESSION["role_descriptor"] != "Admin"){
            $readonly = true;
        }
        else{
            $readonly = false;
        }
    ?>

<div class="form-padding">
<?php echo "<form action='update.php?id=$form_id' method='POST' enctype='multipart/form-data'>"; ?>
<fieldset <?php echo $readonly ? 'disabled' : ''; ?> style="border:0" class="wrapper">

<div class="col-1">
<div class="container-div">
    <h2>
        Vehicle Information
    </h2>

    <select name="garageselector" <?php echo ($_SESSION["role_descriptor"] != 'Admin') ? 'disabled' : ''; ?>>
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

<div class="container-div">
<h2>
    Exterior
</h2>

    <label for="options" class="yes-no-labels">Yes  No</label><br>
    <input type="radio" id="wheelbearings1" name="wheelbearings"  value="True" <?php echo ($wheelbearings == 'True') ? 'checked' : ''; ?> onclick="hideFunction('wheelbearingstext')" required>
    <input type="radio" id="wheelbearings2" name="wheelbearings" value="False" <?php echo ($wheelbearings == 'False') ? 'checked' : ''; ?> onclick="revealFunction('wheelbearingstext')" required>
    <label for="wheelbearings">No play in the wheel bearings (Grab tires and wiggle them hard)</label><br>
    
    <div id="wheelbearingstext" style="display:none">

        <textarea id="wheelbearingsnotes" name="wheelbearingsnotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $wheelbearingsnotes ?></textarea><br>

        <label for="wheelbearingsimg">Image(s) of the issue:</label>
        <input type="file" id="wheelbearingsimg" name="wheelbearingsimg" accept="image/*" ><br>
        <img src="<?php echo $wheelbearingsimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="wheelcheck1" name="wheelcheck" value="True" <?php echo ($wheelcheck == 'True') ? 'checked' : ''; ?> onclick="hideFunction('wheelchecktext')" required>
    <input type="radio" id="wheelcheck2" name="wheelcheck" value="False" <?php echo ($wheelcheck == 'False') ? 'checked' : ''; ?> onclick="revealFunction('wheelchecktext')" required>
    <label for="wheelcheck">Wheels are tight and have no visible cracks</label><br>
    <div id="wheelchecktext" style="display:none">

        <textarea id="wheelchecknotes" name="wheelchecknotes" rows="4" cols="50" placeholder="Describe the issue here..."><?php echo $wheelchecknotes ?></textarea><br>

        <label for="wheelcheckimg">Image(s) of the issue:</label>
        <input type="file" id="wheelcheckimg" name="wheelcheckimg" accept="image/*" ><br>
        <img src="<?php echo $wheelcheckimg; ?>" class="img-wrapper">
        
    </div>

    <input type="radio" id="hubcaps1" name="hubcaps" value="True" <?php echo ($hubcaps == 'True') ? 'checked' : ''; ?> onclick="hideFunction('hubcapstext')" required>
    <input type="radio" id="hubcaps2" name="hubcaps" value="False" <?php echo ($hubcaps == 'False') ? 'checked' : ''; ?> onclick="revealFunction('hubcapstext')" required>
    <label for="hubcaps">Hubcaps or center caps removed or firmly secured by lug nuts (if applicable)</label><br>
    <div id="hubcapstext" style="display:none">

        <textarea id="hubcapsnotes" name="hubcapsnotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $hubcapsnotes ?></textarea><br>

        <label for="hubcapsimg">Image(s) of the issue:</label>
        <input type="file" id="hubcapsimg" name="hubcapsimg" accept="image/*" ><br>
        <img src="<?php echo $hubcapsimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="tirecheck1" name="tirecheck" value="True" <?php echo ($tirecheck == 'True') ? 'checked' : ''; ?> onclick="hideFunction('tirechecktext')" required>
    <input type="radio" id="tirecheck2" name="tirecheck" value="False" <?php echo ($tirecheck == 'False') ? 'checked' : ''; ?> onclick="revealFunction('tirechecktext')" required>
    <label for="tirecheck">Tires must be in good condition with no cords/belts showing or cracks</label><br>
    <div id="tirechecktext" style="display:none">

        <textarea id="tirechecknotes" name="tirechecknotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $tirechecknotes ?></textarea><br>

        <label for="tirecheckimg">Image(s) of the issue:</label>
        <input type="file" id="tirecheckimg" name="tirecheckimg" accept="image/*" ><br>
        <img src="<?php echo $tirecheckimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="tiretreads1" name="tiretreads" value="True" <?php echo ($tiretreads == 'True') ? 'checked' : ''; ?> onclick="hideFunction('tiretreadstext')" required>
    <input type="radio" id="tiretreads2" name="tiretreads" value="False" <?php echo ($tiretreads == 'False') ? 'checked' : ''; ?> onclick="revealFunction('tiretreadstext')" required>
    <label for="tiretreads">Tire tread depth (as appropriate)</label><br>
    <div id="tiretreadstext" style="display:none">

        <textarea id="tiretreadsnotes" name="tiretreadsnotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $tiretreadsnotes ?></textarea><br>

        <label for="tiretreadsimg">Image(s) of the issue:</label>
        <input type="file" id="tiretreadsimg" name="tiretreadsimg" accept="image/*" ><br>
        <img src="<?php echo $tiretreadsimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="brakecheck1" name="brakecheck" value="True" <?php echo ($brakecheck == 'True') ? 'checked' : ''; ?> onclick="hideFunction('brakechecktext')" required>
    <input type="radio" id="brakecheck2" name="brakecheck" value="False" <?php echo ($brakecheck == 'False') ? 'checked' : ''; ?> onclick="revealFunction('brakechecktext')" required>
    <label for="brakecheck">Brake pads/rotors in good condition</label><br>
    <div id="brakechecktext" style="display:none">

        <textarea id="brakechecknotes" name="brakechecknotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $brakechecknotes ?></textarea><br>

        <label for="brakecheckimg">Image(s) of the issue:</label>
        <input type="file" id="brakecheckimg" name="brakecheckimg" accept="image/*" ><br>
        <img src="<?php echo $brakecheckimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="bodypanels1" name="bodypanels" value="True" <?php echo ($bodypanels == 'True') ? 'checked' : ''; ?> onclick="hideFunction('bodypanelstext')" required>
    <input type="radio" id="bodypanels2" name="bodypanels" value="False" <?php echo ($bodypanels == 'False') ? 'checked' : ''; ?> onclick="revealFunction('bodypanelstext')" required>
    <label for="bodypanels">No loose body panels</label><br>
    <div id="bodypanelstext" style="display:none">

        <textarea id="bodypanelsnotes" name="bodypanelsnotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $bodypanelsnotes ?></textarea><br>

        <label for="bodypanelsimg">Image(s) of the issue:</label>
        <input type="file" id="bodypanelsimg" name="bodypanelsimg" accept="image/*" ><br>
        <img src="<?php echo $bodypanelsimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="numbers1" name="numbers" value="True" <?php echo ($numbers == 'True') ? 'checked' : ''; ?> onclick="hideFunction('numberstext')" required>
    <input type="radio" id="numbers2" name="numbers" value="False" <?php echo ($numbers == 'False') ? 'checked' : ''; ?> onclick="revealFunction('numberstext')" required>
    <label for="numbers">Numbers on & clearly visible on body (no blue tape on a blue car & not window)</label><br>
    <div id="numberstext" style="display:none">

        <textarea id="numbersnotes" name="numbersnotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $numbersnotes ?></textarea><br>

        <label for="numbersimg">Image(s) of the issue:</label>
        <input type="file" id="numbersimg" name="numbersimg" accept="image/*" ><br>
        <img src="<?php echo $numbersimg; ?>" class="img-wrapper">
    </div>

    <label for="exteriorimg">Extra Images (if necessary):</label>
    <input type="file" id="exteriorimg" name="exteriorimg" accept="image/*" ><br>
    <img src="<?php echo $exteriorimg; ?>" class="img-wrapper">
</div>

<div class="container-div">
<h2>
    Under the Hood and Trunk
</h2>
    <label for="options" class="yes-no-labels">Yes  No</label><br>
    <input type="radio" id="battery1" name="battery" value="True" <?php echo ($battery == 'True') ? 'checked' : ''; ?> onclick="hideFunction('batterytext')" required>
    <input type="radio" id="battery2" name="battery" value="False" <?php echo ($battery == 'False') ? 'checked' : ''; ?> onclick="revealFunction('batterytext')" required>
    <label for="battery">Battery and connections secure</label><br>
    <div id="batterytext" style="display:none">

        <textarea id="batterynotes" name="batterynotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $batterynotes ?></textarea><br>

        <label for="batteryimg">Image(s) of the issue:</label>
        <input type="file" id="batteryimg" name="batteryimg" accept="image/*" ><br>
        <img src="<?php echo $batteryimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="airintake1" name="airintake" value="True" <?php echo ($airintake == 'True') ? 'checked' : ''; ?> onclick="hideFunction('airintaketext')" required>
    <input type="radio" id="airintake2" name="airintake" value="False" <?php echo ($airintake == 'False') ? 'checked' : ''; ?> onclick="revealFunction('airintaketext')" required>
    <label for="airintake">Air intake or air box secure</label><br>
    <div id="airintaketext" style="display:none">

        <textarea id="airintakenotes" name="airintakenotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $airintakenotes ?></textarea><br>

        <label for="airintakeimg">Image(s) of the issue:</label>
        <input type="file" id="airintakeimg" name="airintakeimg" accept="image/*" ><br>
        <img src="<?php echo $airintakeimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="throttlecable1" name="throttlecable" value="True" <?php echo ($throttlecable == 'True') ? 'checked' : ''; ?> onclick="hideFunction('throttlecabletext')" required>
    <input type="radio" id="throttlecable2" name="throttlecable" value="False" <?php echo ($throttlecable == 'False') ? 'checked' : ''; ?> onclick="revealFunction('throttlecabletext')" required>
    <label for="throttlecable">Throttle cable secure (if applicable)</label><br>
    <div id="throttlecabletext" style="display:none">

        <textarea id="throttlecablenotes" name="throttlecablenotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $throttlecablenotes ?></textarea><br>

        <label for="throttlecableimg">Image(s) of the issue:</label>
        <input type="file" id="throttlecableimg" name="throttlecableimg" accept="image/*" ><br>
        <img src="<?php echo $throttlecableimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="fluidcaps1" name="fluidcaps" value="True" <?php echo ($fluidcaps == 'True') ? 'checked' : ''; ?> onclick="hideFunction('fluidcapstext')" required>
    <input type="radio" id="fluidcaps2" name="fluidcaps" value="False" <?php echo ($fluidcaps == 'False') ? 'checked' : ''; ?> onclick="revealFunction('fluidcapstext')" required>
    <label for="fluidcaps">All fluid caps secure</label><br>
    <div id="fluidcapstext" style="display:none">

        <textarea id="fluidcapsnotes" name="fluidcapsnotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $fluidcapsnotes ?></textarea><br>

        <label for="fluidcapsimg">Image(s) of the issue:</label>
        <input type="file" id="fluidcapsimg" name="fluidcapsimg" accept="image/*" ><br>
        <img src="<?php echo $fluidcapsimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="leakcheck1" name="leakcheck" value="True" <?php echo ($leakcheck == 'True') ? 'checked' : ''; ?> onclick="hideFunction('leakchecktext')" required>
    <input type="radio" id="leakcheck2" name="leakcheck" value="False" <?php echo ($leakcheck == 'False') ? 'checked' : ''; ?> onclick="revealFunction('leakchecktext')" required>
    <label for="leakcheck">No <i>major</i> leaks apparent</label><br>
    <div id="leakchecktext" style="display:none">

        <textarea id="leakchecknotes" name="leakchecknotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $leakchecknotes ?></textarea><br>

        <label for="leakcheckimg">Image(s) of the issue:</label>
        <input type="file" id="leakcheckimg" name="leakcheckimg" accept="image/*" ><br>
        <img src="<?php echo $leakcheckimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="trunk1" name="trunk" value="True" <?php echo ($trunk == 'True') ? 'checked' : ''; ?> onclick="hideFunction('trunktext')" required>
    <input type="radio" id="trunk2" name="trunk" value="False" <?php echo ($trunk == 'False') ? 'checked' : ''; ?> onclick="revealFunction('trunktext')" required>
    <label for="trunk">Trunk is empty of items that move around</label><br>
    <div id="trunktext" style="display:none">

        <textarea id="trunknotes" name="trunknotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $trunknotes ?></textarea><br>

        <label for="trunkimg">Image(s) of the issue:</label>
        <input type="file" id="trunkimg" name="trunkimg" accept="image/*" ><br>
        <img src="<?php echo $trunkimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="exhaust1" name="exhaust" value="True" <?php echo ($exhaust == 'True') ? 'checked' : ''; ?> onclick="hideFunction('exhausttext')" required>
    <input type="radio" id="exhaust2" name="exhaust" value="False" <?php echo ($exhaust == 'False') ? 'checked' : ''; ?> onclick="revealFunction('exhausttext')" required>
    <label for="exhaust">Functional exhaust system that's not excessively loud and exit behind driver</label><br>
    <div id="exhausttext" style="display:none">

        <textarea id="exhaustnotes" name="exhaustnotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $exhaustnotes ?></textarea><br>

        <label for="exhaustimg">Image(s) of the issue:</label>
        <input type="file" id="exhaustimg" name="exhaustimg" accept="image/*" ><br>
        <img src="<?php echo $exhaustimg; ?>" class="img-wrapper">
    </div>

    <label for="hoodimg">Extra Images (if necessary):</label>
    <input type="file" id="hoodimg" name="hoodimg" accept="image/*" ><br>
    <img src="<?php echo $hoodimg; ?>" class="img-wrapper">
</div>
</div>

<div class="col-2">
<div class="container-div">
<h2>
    Interior
</h2>
    <label for="options" class="yes-no-labels">Yes  No</label><br>
    <input type="radio" id="floormats1" name="floormats" value="True" <?php echo ($floormats == 'True') ? 'checked' : ''; ?> onclick="hideFunction('floormatstext')" required>
    <input type="radio" id="floormats2" name="floormats" value="False" <?php echo ($floormats == 'False') ? 'checked' : ''; ?> onclick="revealFunction('floormatstext')" required>
    <label for="floormats">Floor mats and all other loose items removed from car</label><br>
    <div id="floormatstext" style="display:none">

        <textarea id="floormatsnotes" name="floormatsnotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $floormatsnotes ?></textarea><br>

        <label for="floormatsimg">Image(s) of the issue:</label>
        <input type="file" id="floormatsimg" name="floormatsimg" accept="image/*" ><br>
        <img src="<?php echo $floormatsimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="pedalscheck1" name="pedalscheck" value="True" <?php echo ($pedalscheck == 'True') ? 'checked' : ''; ?> onclick="hideFunction('pedalschecktext')" required>
    <input type="radio" id="pedalscheck2" name="pedalscheck" value="False" <?php echo ($pedalscheck == 'False') ? 'checked' : ''; ?> onclick="revealFunction('pedalschecktext')" required>
    <label for="pedalscheck">Brake, throttle, and clutch (if applicable) pedals secure</label><br>
    <div id="pedalschecktext" style="display:none">

        <textarea id="pedalschecknotes" name="pedalschecknotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $pedalschecknotes ?></textarea><br>

        <label for="pedalscheckimg">Image(s) of the issue:</label>
        <input type="file" id="pedalscheckimg" name="pedalscheckimg" accept="image/*" ><br>
        <img src="<?php echo $pedalscheckimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="brakepedal1" name="brakepedal" value="True" <?php echo ($brakepedal == 'True') ? 'checked' : ''; ?> onclick="hideFunction('brakepedaltext')" required>
    <input type="radio" id="brakepedal2" name="brakepedal" value="False" <?php echo ($brakepedal == 'False') ? 'checked' : ''; ?> onclick="revealFunction('brakepedaltext')" required>
    <label for="brakepedal">Firm brake pedal</label><br>
    <div id="brakepedaltext" style="display:none">

        <textarea id="brakepedalnotes" name="brakepedalnotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $brakepedalnotes ?></textarea><br>

        <label for="brakepedalimg">Image(s) of the issue:</label>
        <input type="file" id="brakepedalimg" name="brakepedalimg" accept="image/*" ><br>
        <img src="<?php echo $brakepedalimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="steering1" name="steering" value="True" <?php echo ($steering == 'True') ? 'checked' : ''; ?> onclick="hideFunction('steeringtext')" required>
    <input type="radio" id="steering2" name="steering" value="False" <?php echo ($steering == 'False') ? 'checked' : ''; ?> onclick="revealFunction('steeringtext')" required>
    <label for="steering">No excessive play in the steering</label><br>
    <div id="steeringtext" style="display:none">

        <textarea id="steeringnotes" name="steeringnotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $steeringnotes ?></textarea><br>

        <label for="steeringimg">Image(s) of the issue:</label>
        <input type="file" id="steeringimg" name="steeringimg" accept="image/*" ><br>
        <img src="<?php echo $steeringimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="gearselector1" name="gearselector" value="True" <?php echo ($gearselector == 'True') ? 'checked' : ''; ?> onclick="hideFunction('gearselectortext')" required>
    <input type="radio" id="gearselector2" name="gearselector" value="False" <?php echo ($gearselector == 'False') ? 'checked' : ''; ?> onclick="revealFunction('gearselectortext')" required>
    <label for="gearselector">No excessive play in gear selector</label><br>
    <div id="gearselectortext" style="display:none">

        <textarea id="gearselectornotes" name="gearselectornotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $gearselectornotes ?></textarea><br>

        <label for="gearselectorimg">Image(s) of the issue:</label>
        <input type="file" id="gearselectorimg" name="gearselectorimg" accept="image/*" ><br>
        <img src="<?php echo $gearselectorimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="seat1" name="seat" value="True" <?php echo ($seat == 'True') ? 'checked' : ''; ?> onclick="hideFunction('seattext')" required>
    <input type="radio" id="seat2" name="seat" value="False" <?php echo ($seat == 'False') ? 'checked' : ''; ?> onclick="revealFunction('seattext')" required>
    <label for="seat">Seat in functional order</label><br>
    <div id="seattext" style="display:none">

        <textarea id="seatnotes" name="seatnotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $seatnotes ?></textarea><br>

        <label for="seatimg">Image(s) of the issue:</label>
        <input type="file" id="seatimg" name="seatimg" accept="image/*" ><br>
        <img src="<?php echo $seatimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="seatbelt1" name="seatbelt" value="True" <?php echo ($seatbelt == 'True') ? 'checked' : ''; ?> onclick="hideFunction('seatbelttext')" required>
    <input type="radio" id="seatbelt2" name="seatbelt" value="False" <?php echo ($seatbelt == 'False') ? 'checked' : ''; ?> onclick="revealFunction('seatbelttext')" required>
    <label for="seatbelt">Seat belt proper for year of car and class</label><br>
    <div id="seatbelttext" style="display:none">

        <textarea id="seatbeltnotes" name="seatbeltnotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $seatbeltnotes ?></textarea><br>

        <label for="seatbeltimg">Image(s) of the issue:</label>
        <input type="file" id="seatbeltimg" name="seatbeltimg" accept="image/*" ><br>
        <img src="<?php echo $seatbeltimg; ?>" class="img-wrapper">
    </div>

    <input type="radio" id="camerascheck1" name="camerascheck" value="True" <?php echo ($camerascheck == 'True') ? 'checked' : ''; ?> onclick="hideFunction('cameraschecktext')" required>
    <input type="radio" id="camerascheck2" name="camerascheck" value="False" <?php echo ($camerascheck == 'False') ? 'checked' : ''; ?> onclick="revealFunction('cameraschecktext')" required>
    <label for="camerascheck">Cameras, phones, and other gear mounted to car</label><br>
    <div id="cameraschecktext" style="display:none">

        <textarea id="cameraschecknotes" name="cameraschecknotes" placeholder="Describe the issue here..." rows="4" cols="50"><?php echo $cameraschecknotes ?></textarea><br>

        <label for="camerascheckimg">Image(s) of the issue:</label>
        <input type="file" id="camerascheckimg" name="camerascheckimg" accept="image/*" ><br>
        <img src="<?php echo $camerascheckimg; ?>" class="img-wrapper">
    </div>

    <label for="interiorimg">Extra Images (if necessary):</label>
    <input type="file" id="interiorimg" name="interiorimg" accept="image/*" ><br>
    <img src="<?php echo $interiorimg; ?>" class="img-wrapper">
</div>

<div class="flex-column">

    <div class="sig_wrapper">
        <canvas id="signature-pad" width="400" height="200" name="signature-pad"></canvas>
    </div>
    <input type="hidden" id="signature_image" name="signature_image" value="" required>
    <div class="flex-row">
        <button id="clear" type="button"><span> Clear </span></button>
        <button id="sign" type="button" required><span> Sign </span></button>
    </div>
</div>

<!--Driver information, extra notes, and inspection information for the tech inspector-->
<div class="container-div">
<h2>
    Notes
</h2>

    <textarea id="extranotes" name="extranotes" placeholder="Enter any extra comments here..." rows="4" cols="50"><?php echo $extranotes ?></textarea><br>

    <label for="notesimg">Extra Images (if necessary):</label>
    <input type="file" id="notesimg" name="notesimg" accept="image/*" ><br>
    <img src="<?php echo $notesimg; ?>" class="img-wrapper">
</div>

<div class="container-div" >


<h2>
    Driver Information
</h2>

<h5><?php echo $first_name . " " . $last_name ?></h5>

<label for="options" class="yes-no-labels">Yes  No</label><br>
    <input type="radio" id="helmet1" name="helmet" value="True" <?php echo ($helmet_status == 'True') ? 'checked' : ''; ?> disabled required>
    <input type="radio" id="helmet2" name="helmet" value="False" <?php echo ($helmet_status == 'False') ? 'checked' : ''; ?> disabled required>
    <label for="helmet">Yearly Helmet Inspection?</label><br>

    <input type="radio" id="novice1" name="novice" value="True" <?php echo ($novice_driver == 'True') ? 'checked' : ''; ?> disabled required>
    <input type="radio" id="novice2" name="novice" value="False" <?php echo ($novice_driver == 'False') ? 'checked' : ''; ?> disabled required>
    <label for="helmet">Novice Driver?</label><br>

    <label for="inspectdate">Last Date of Inspection:</label>
    <input type="date" id="inspectdate" name="inspectdate" value="<?php echo (isset($inspection_date)) ? $inspection_date: date('Y-m-d'); ?>" readonly/><br>
    <?php if (date("Y-m-d", strtotime('-1 year')) > $inspection_date): ?>
        <p>The helmet needs to be inspected!</p>
    <?php endif; ?>

    <label for="helmetimg">Image of Helmet:</label>
    <input type="file" id="helmetimg" name="helmetimg" accept="image/*" disabled><br>
    <img src="<?php echo $helmetimg; ?>" class="img-wrapper">


<h2>
    Inspection Information
</h2>
<label for="options" class="yes-no-labels">Yes  No</label><br>
<input type="radio" id="annualinspect1" name="annualinspect" value="True" <?php echo ($annualinspect == 'True') ? 'checked' : ''; ?> <?php echo ($_SESSION["role_descriptor"] == 'Owner') ? 'disabled' : ''; ?>>
<input type="radio" id="annualinspect2" name="annualinspect" value="False" <?php echo ($annualinspect == 'False') ? 'checked' : ''; ?> <?php echo ($_SESSION["role_descriptor"] == 'Owner') ? 'disabled' : ''; ?>>
<label for="annualinspect">Annual Tech Inspection?</label><br>

<label for="inspectinitials">Inspector Initials:</label>
<input type="text" id="inspectinitials" name="inspectinitials" value="<?php echo $inspectinitials ?>" <?php echo ($_SESSION["role_descriptor"] == 'Owner') ? 'readonly' : ''; ?> required>


</div>


<input type="submit" value="Submit" name="submit" id="submit2">
</div>
</fieldset>
</form>    
</div>

<script>
    //All the info for creating and using the SignaturePad
    var canvas = document.getElementById("signature-pad");

    function resizeCanvas() {

        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);

    }
    window.onresize = resizeCanvas;
    resizeCanvas();

    var signaturePad = new SignaturePad(canvas, {
    backgroundColor: 'rgb(250,250,250)'
    });

    signaturePad.fromDataURL("<?php echo $signature_pad; ?>");

    document.getElementById("clear").addEventListener('click', function(){
    signaturePad.clear();
    });
    document.getElementById("sign").addEventListener('click', function(){
        signature_image.value = signaturePad.toDataURL();
    });
    //Still save the signature, even if they forget to click "sign"
    document.getElementById("submit2").addEventListener('mousedown', function(){
        signature_image.value = signaturePad.toDataURL();
    });

</script>











<!--GENERATE A NEW FORM CODE-->
<!--Info in this form is essentially identical to the already
    filled-out form, sans filled-out data-->






<?php else: ?>

<div class="form-padding">
<form action="store.php" method="POST" enctype="multipart/form-data">
<fieldset class="wrapper" style="border: 0;">
<div class="float:left">

<div class="col-1">

<div class="container-div">
    <h2>
        Vehicle Information
    </h2>

    <select name="garageselector" required>
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

<div class="container-div">
<h2>
    Exterior
</h2>
    <label for="options" class="yes-no-labels">Yes  No</label><br>
    <input type="radio" id="wheelbearings1" name="wheelbearings"  value="True" onclick="hideFunction('wheelbearingstext')" required>
    <input type="radio" id="wheelbearings2" name="wheelbearings" value="False" onclick="revealFunction('wheelbearingstext')" required>
    <label for="wheelbearings">No play in the wheel bearings (Grab tires and wiggle them hard)</label><br>
    
    <div id="wheelbearingstext" style="display:none">

        <textarea id="wheelbearingsnotes" name="wheelbearingsnotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="wheelbearingsimg">Image(s) of the issue:</label>
        <input type="file" id="wheelbearingsimg" name="wheelbearingsimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="wheelcheck1" name="wheelcheck" value="True" onclick="hideFunction('wheelchecktext')" required>
    <input type="radio" id="wheelcheck2" name="wheelcheck" value="False" onclick="revealFunction('wheelchecktext')" required>
    <label for="wheelcheck">Wheels are tight and have no visible cracks</label><br>
    <div id="wheelchecktext" style="display:none">

        <textarea id="wheelchecknotes" name="wheelchecknotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="wheelcheckimg">Image(s) of the issue:</label>
        <input type="file" id="wheelcheckimg" name="wheelcheckimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="hubcaps1" name="hubcaps" value="True" onclick="hideFunction('hubcapstext')" required>
    <input type="radio" id="hubcaps2" name="hubcaps" value="False" onclick="revealFunction('hubcapstext')" required>
    <label for="hubcaps">Hubcaps or center caps removed or firmly secured by lug nuts (if applicable)</label><br>
    <div id="hubcapstext" style="display:none">

        <textarea id="hubcapsnotes" name="hubcapsnotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="hubcapsimg">Image(s) of the issue:</label>
        <input type="file" id="hubcapsimg" name="hubcapsimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="tirecheck1" name="tirecheck" value="True" onclick="hideFunction('tirechecktext')" required>
    <input type="radio" id="tirecheck2" name="tirecheck" value="False" onclick="revealFunction('tirechecktext')" required>
    <label for="tirecheck">Tires must be in good condition with no cords/belts showing or cracks</label><br>
    <div id="tirechecktext" style="display:none">

        <textarea id="tirechecknotes" name="tirechecknotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="tirecheckimg">Image(s) of the issue:</label>
        <input type="file" id="tirecheckimg" name="tirecheckimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="tiretreads1" name="tiretreads" value="True" onclick="hideFunction('tiretreadstext')" required>
    <input type="radio" id="tiretreads2" name="tiretreads" value="False" onclick="revealFunction('tiretreadstext')" required>
    <label for="tiretreads">Tire tread depth (as appropriate)</label><br>
    <div id="tiretreadstext" style="display:none">

        <textarea id="tiretreadsnotes" name="tiretreadsnotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="tiretreadsimg">Image(s) of the issue:</label>
        <input type="file" id="tiretreadsimg" name="tiretreadsimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="brakecheck1" name="brakecheck" value="True" onclick="hideFunction('brakechecktext')" required>
    <input type="radio" id="brakecheck2" name="brakecheck" value="False" onclick="revealFunction('brakechecktext')" required>
    <label for="brakecheck">Brake pads/rotors in good condition</label><br>
    <div id="brakechecktext" style="display:none">

        <textarea id="brakechecknotes" name="brakechecknotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="brakecheckimg">Image(s) of the issue:</label>
        <input type="file" id="brakecheckimg" name="brakecheckimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="bodypanels1" name="bodypanels" value="True" onclick="hideFunction('bodypanelstext')" required>
    <input type="radio" id="bodypanels2" name="bodypanels" value="False" onclick="revealFunction('bodypanelstext')" required>
    <label for="bodypanels">No loose body panels</label><br>
    <div id="bodypanelstext" style="display:none">

        <textarea id="bodypanelsnotes" name="bodypanelsnotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="bodypanelsimg">Image(s) of the issue:</label>
        <input type="file" id="bodypanelsimg" name="bodypanelsimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="numbers1" name="numbers" value="True" onclick="hideFunction('numberstext')" required>
    <input type="radio" id="numbers2" name="numbers" value="False" onclick="revealFunction('numberstext')" required>
    <label for="numbers">Numbers on & clearly visible on body (no blue tape on a blue car & not window)</label><br>
    <div id="numberstext" style="display:none">

        <textarea id="numbersnotes" name="numbersnotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="numbersimg">Image(s) of the issue:</label>
        <input type="file" id="numbersimg" name="numbersimg" accept="image/*" ><br>
    </div>

    <label for="exteriorimg">Extra Images (if necessary):</label>
    <input type="file" id="exteriorimg" name="exteriorimg" accept="image/*" ><br>
</div>

<div class="container-div">
<h2>
    Under the Hood and Trunk
</h2>
    <label for="options" class="yes-no-labels">Yes  No</label><br>
    <input type="radio" id="battery1" name="battery" value="True" onclick="hideFunction('batterytext')" required>
    <input type="radio" id="battery2" name="battery" value="False" onclick="revealFunction('batterytext')" required>
    <label for="battery">Battery and connections secure</label><br>
    <div id="batterytext" style="display:none">

        <textarea id="batterynotes" name="batterynotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="batteryimg">Image(s) of the issue:</label>
        <input type="file" id="batteryimg" name="batteryimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="airintake1" name="airintake" value="True" onclick="hideFunction('airintaketext')" required>
    <input type="radio" id="airintake2" name="airintake" value="False" onclick="revealFunction('airintaketext')" required>
    <label for="airintake">Air intake or air box secure</label><br>
    <div id="airintaketext" style="display:none">

        <textarea id="airintakenotes" name="airintakenotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="airintakeimg">Image(s) of the issue:</label>
        <input type="file" id="airintakeimg" name="airintakeimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="throttlecable1" name="throttlecable" value="True" onclick="hideFunction('throttlecabletext')" required>
    <input type="radio" id="throttlecable2" name="throttlecable" value="False" onclick="revealFunction('throttlecabletext')" required>
    <label for="throttlecable">Throttle cable secure (if applicable)</label><br>
    <div id="throttlecabletext" style="display:none">

        <textarea id="throttlecablenotes" name="throttlecablenotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="throttlecableimg">Image(s) of the issue:</label>
        <input type="file" id="throttlecableimg" name="throttlecableimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="fluidcaps1" name="fluidcaps" value="True" onclick="hideFunction('fluidcapstext')" required>
    <input type="radio" id="fluidcaps2" name="fluidcaps" value="False" onclick="revealFunction('fluidcapstext')" required>
    <label for="fluidcaps">All fluid caps secure</label><br>
    <div id="fluidcapstext" style="display:none">

        <textarea id="fluidcapsnotes" name="fluidcapsnotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="fluidcapsimg">Image(s) of the issue:</label>
        <input type="file" id="fluidcapsimg" name="fluidcapsimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="leakcheck1" name="leakcheck" value="True" onclick="hideFunction('leakchecktext')" required>
    <input type="radio" id="leakcheck2" name="leakcheck" value="False" onclick="revealFunction('leakchecktext')" required>
    <label for="leakcheck">No <i>major</i> leaks apparent</label><br>
    <div id="leakchecktext" style="display:none">

        <textarea id="leakchecknotes" name="leakchecknotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="leakcheckimg">Image(s) of the issue:</label>
        <input type="file" id="leakcheckimg" name="leakcheckimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="trunk1" name="trunk" value="True" onclick="hideFunction('trunktext')" required>
    <input type="radio" id="trunk2" name="trunk" value="False" onclick="revealFunction('trunktext')" required>
    <label for="trunk">Trunk is empty of items that move around</label><br>
    <div id="trunktext" style="display:none">

        <textarea id="trunknotes" name="trunknotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="trunkimg">Image(s) of the issue:</label>
        <input type="file" id="trunkimg" name="trunkimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="exhaust1" name="exhaust" value="True" onclick="hideFunction('exhausttext')" required>
    <input type="radio" id="exhaust2" name="exhaust" value="False" onclick="revealFunction('exhausttext')" required>
    <label for="exhaust">Functional exhaust system that's not excessively loud and exit behind driver</label><br>
    <div id="exhausttext" style="display:none">

        <textarea id="exhaustnotes" name="exhaustnotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="exhaustimg">Image(s) of the issue:</label>
        <input type="file" id="exhaustimg" name="exhaustimg" accept="image/*" ><br>
    </div>

    <label for="hoodimg">Extra Images (if necessary):</label>
    <input type="file" id="hoodimg" name="hoodimg" accept="image/*" ><br>
</div>
</div>
</div>
<div class="col-2">
<div class="container-div">
<h2>
    Interior
</h2>
    <label for="options" class="yes-no-labels">Yes  No</label><br>
    <input type="radio" id="floormats1" name="floormats" value="True" onclick="hideFunction('floormatstext')" required>
    <input type="radio" id="floormats2" name="floormats" value="False" onclick="revealFunction('floormatstext')" required>
    <label for="floormats">Floor mats and all other loose items removed from car</label><br>
    <div id="floormatstext" style="display:none">

        <textarea id="floormatsnotes" name="floormatsnotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="floormatsimg">Image(s) of the issue:</label>
        <input type="file" id="floormatsimg" name="floormatsimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="pedalscheck1" name="pedalscheck" value="True" onclick="hideFunction('pedalschecktext')" required>
    <input type="radio" id="pedalscheck2" name="pedalscheck" value="False" onclick="revealFunction('pedalschecktext')" required>
    <label for="pedalscheck">Brake, throttle, and clutch (if applicable) pedals secure</label><br>
    <div id="pedalschecktext" style="display:none">

        <textarea id="pedalschecknotes" name="pedalschecknotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="pedalscheckimg">Image(s) of the issue:</label>
        <input type="file" id="pedalscheckimg" name="pedalscheckimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="brakepedal1" name="brakepedal" value="True" onclick="hideFunction('brakepedaltext')" required>
    <input type="radio" id="brakepedal2" name="brakepedal" value="False" onclick="revealFunction('brakepedaltext')" required>
    <label for="brakepedal">Firm brake pedal</label><br>
    <div id="brakepedaltext" style="display:none">

        <textarea id="brakepedalnotes" name="brakepedalnotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="brakepedalimg">Image(s) of the issue:</label>
        <input type="file" id="brakepedalimg" name="brakepedalimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="steering1" name="steering" value="True" onclick="hideFunction('steeringtext')" required>
    <input type="radio" id="steering2" name="steering" value="False" onclick="revealFunction('steeringtext')" required>
    <label for="steering">No excessive play in the steering</label><br>
    <div id="steeringtext" style="display:none">

        <textarea id="steeringnotes" name="steeringnotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="steeringimg">Image(s) of the issue:</label>
        <input type="file" id="steeringimg" name="steeringimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="gearselector1" name="gearselector" value="True" onclick="hideFunction('gearselectortext')" required>
    <input type="radio" id="gearselector2" name="gearselector" value="False" onclick="revealFunction('gearselectortext')" required>
    <label for="gearselector">No excessive play in gear selector</label><br>
    <div id="gearselectortext" style="display:none">

        <textarea id="gearselectornotes" name="gearselectornotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="gearselectorimg">Image(s) of the issue:</label>
        <input type="file" id="gearselectorimg" name="gearselectorimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="seat1" name="seat" value="True" onclick="hideFunction('seattext')" required>
    <input type="radio" id="seat2" name="seat" value="False" onclick="revealFunction('seattext')" required>
    <label for="seat">Seat in functional order</label><br>
    <div id="seattext" style="display:none">

        <textarea id="seatnotes" name="seatnotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="seatimg">Image(s) of the issue:</label>
        <input type="file" id="seatimg" name="seatimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="seatbelt1" name="seatbelt" value="True" onclick="hideFunction('seatbelttext')" required>
    <input type="radio" id="seatbelt2" name="seatbelt" value="False" onclick="revealFunction('seatbelttext')" required>
    <label for="seatbelt">Seat belt proper for year of car and class</label><br>
    <div id="seatbelttext" style="display:none">

        <textarea id="seatbeltnotes" name="seatbeltnotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="seatbeltimg">Image(s) of the issue:</label>
        <input type="file" id="seatbeltimg" name="seatbeltimg" accept="image/*" ><br>
    </div>

    <input type="radio" id="camerascheck1" name="camerascheck" value="True" onclick="hideFunction('cameraschecktext')" required>
    <input type="radio" id="camerascheck2" name="camerascheck" value="False" onclick="revealFunction('cameraschecktext')" required>
    <label for="camerascheck">Cameras, phones, and other gear mounted to car</label><br>
    <div id="cameraschecktext" style="display:none">

        <textarea id="cameraschecknotes" name="cameraschecknotes" placeholder="Describe the issue here..." rows="4" cols="50"></textarea><br>

        <label for="camerascheckimg">Image(s) of the issue:</label>
        <input type="file" id="camerascheckimg" name="camerascheckimg" accept="image/*" ><br>
    </div>

    <label for="interiorimg">Extra Images (if necessary):</label>
    <input type="file" id="interiorimg" name="interiorimg" accept="image/*" ><br>
</div>

<div class="flex-column">

    <div class="sig_wrapper">
        <canvas id="signature-pad" width="400" height="200" name="signature-pad"></canvas>
    </div>
    <input type="hidden" id="signature_image" name="signature_image" value="" required>
    <div class="flex-row">
        <button id="clear" type="button"><span> Clear </span></button>
        <button id="sign" type="button"><span> Sign </span></button>
    </div>
</div>
<div class="submit-wrapper">
<input type="submit" value="Submit" name="submit" id="submit">
</div>

</div>

</fieldset>
</form>    
</div>
</div>

</body>

<script>
    var canvas = document.getElementById("signature-pad");

    function resizeCanvas() {

        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);

    }
    window.onresize = resizeCanvas;
    resizeCanvas();

    var signaturePad = new SignaturePad(canvas, {
    backgroundColor: 'rgb(250,250,250)'
    });
    document.getElementById("clear").addEventListener('click', function(){
    signaturePad.clear();
    });
    document.getElementById("sign").addEventListener('click', function(event){
        signature_image.value = signaturePad.toDataURL();        
    });
    document.getElementById("submit").addEventListener('mousedown', function(){
        signature_image.value = signaturePad.toDataURL();
    });

</script>

<?php endif; ?>

</html>

<?php mysqli_close($con); ?>