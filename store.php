<!--Written by Jakob Syvertsen-->
<?php

//session information
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

//set the new form to the next highest form_id
$sql = "SELECT form_id FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)";
$id_result = mysqli_query($conn,$sql);
$id_data = mysqli_fetch_array($id_result);

$form_number = $id_data['form_id'] + 1;

$account_id = $_SESSION['account_id'];

//set new target_directory for the images
$target_directory = "images/" . $form_number . "/";
mkdir($target_directory);

//make sure image variables are null
$wheelbearingsimg = NULL;
$wheelcheckimg = NULL;
$hubcapsimg = NULL;
$tirecheckimg = NULL;
$tiretreadsimg = NULL;
$brakecheckimg = NULL;
$bodypanelsimg = NULL;
$numbersimg = NULL;
$exteriorimg = NULL;
$floormatsimg = NULL;
$pedalscheckimg = NULL;
$brakepedalimg = NULL;
$steeringimg = NULL;
$gearselectorimg = NULL;
$seatimg = NULL;
$seatbeltimg = NULL;
$camerascheckimg = NULL;
$interiorimg = NULL;
$batteryimg = NULL;
$airintakeimg = NULL;
$throttlecableimg = NULL;
$fluidcapsimg = NULL;
$leakcheckimg = NULL;
$trunkimg = NULL;
$exhaustimg = NULL;
$hoodimg = NULL;
$signature_pad = NULL;

//set form values from the POSTed form data
$form_date = date("Y-m-d H:i:s", time());

$garageselector = $_REQUEST['garageselector'];

$annualinspect = $_REQUEST['annualinspect'];

$wheelbearings = $_REQUEST['wheelbearings'];

//make sure text inputs are sanitised
$wheelbearingsnotes = mysqli_real_escape_string($conn,$_REQUEST['wheelbearingsnotes']);

//same format for all images. Check if the file name is set, then check if the image size is > 0
//if it is, give the image a unique id in the name, send it to the image directory, put the
//ref link into the DB.
if((isset($_FILES['wheelbearingsimg']['name']) && ($_FILES['wheelbearingsimg']['size'] > 0))): {
$wheelbearingsimg = $target_directory . uniqid(). $_FILES['wheelbearingsimg']['name'];
move_uploaded_file($_FILES['wheelbearingsimg']['tmp_name'], $wheelbearingsimg);
}endif;

$wheelcheck = $_REQUEST['wheelcheck'];

$wheelchecknotes = mysqli_real_escape_string($conn,$_REQUEST['wheelchecknotes']);

if((isset($_FILES['wheelcheckimg']['name']) && ($_FILES['wheelcheckimg']['size'] > 0))): {
$wheelcheckimg = $target_directory . uniqid(). $_FILES['wheelcheckimg']['name'];
move_uploaded_file($_FILES['wheelcheckimg']['tmp_name'], $wheelcheckimg);
}endif;

$hubcaps = $_REQUEST['hubcaps'];

$hubcapsnotes  = mysqli_real_escape_string($conn,$_REQUEST['hubcapsnotes']);

if((isset($_FILES['hubcapsimg']['name']) && ($_FILES['hubcapsimg']['size'] > 0))): {
$hubcapsimg = $target_directory . uniqid(). $_FILES['hubcapsimg']['name'];
move_uploaded_file($_FILES['hubcapsimg']['tmp_name'], $hubcapsimg);
}endif;

$tirecheck = $_REQUEST['tirecheck'];

$tirechecknotes = mysqli_real_escape_string($conn,$_REQUEST['tirechecknotes']);

if((isset($_FILES['tirecheckimg']['name']) && ($_FILES['tirecheckimg']['size'] > 0))): {
$tirecheckimg = $target_directory . uniqid(). $_FILES['tirecheckimg']['name'];
move_uploaded_file($_FILES['tirecheckimg']['tmp_name'], $tirecheckimg);
}endif;

$tiretreads = $_REQUEST['tiretreads'];

$tiretreadsnotes = mysqli_real_escape_string($conn,$_REQUEST['tiretreadsnotes']);

if((isset($_FILES['tiretreadsimg']['name']) && ($_FILES['tiretreadsimg']['size'] > 0))): {
$tiretreadsimg = $target_directory . uniqid(). $_FILES['tiretreadsimg']['name'];
move_uploaded_file($_FILES['tiretreadsimg']['tmp_name'], $tiretreadsimg);
}endif;

$brakecheck = $_REQUEST['brakecheck'];

$brakechecknotes = mysqli_real_escape_string($conn,$_REQUEST['brakechecknotes']);

if((isset($_FILES['brakecheckimg']['name']) && ($_FILES['brakecheckimg']['size'] > 0))): {
$brakecheckimg = $target_directory . uniqid(). $_FILES['brakecheckimg']['name'];
move_uploaded_file($_FILES['brakecheckimg']['tmp_name'], $brakecheckimg);
}endif;

$bodypanels = $_REQUEST['bodypanels'];

$bodypanelsnotes = mysqli_real_escape_string($conn,$_REQUEST['bodypanelsnotes']);

if((isset($_FILES['bodypanelsimg']['name']) && ($_FILES['bodypanelsimg']['size'] > 0))): {
$bodypanelsimg = $target_directory . uniqid(). $_FILES['bodypanelsimg']['name'];
move_uploaded_file($_FILES['bodypanelsimg']['tmp_name'], $bodypanelsimg);
}endif;

$numbers = $_REQUEST['numbers'];

$numbersnotes  = mysqli_real_escape_string($conn,$_REQUEST['numbersnotes']);

if((isset($_FILES['numbersimg']['name']) && ($_FILES['numbersimg']['size'] > 0))): {
$numbersimg = $target_directory . uniqid(). $_FILES['numbersimg']['name'];
move_uploaded_file($_FILES['numbersimg']['tmp_name'], $numbersimg);
}endif;

if((isset($_FILES['exteriorimg']['name']) && ($_FILES['exteriorimg']['size'] > 0))): {
$exteriorimg = $target_directory . uniqid(). $_FILES['exteriorimg']['name'];
move_uploaded_file($_FILES['exteriorimg']['tmp_name'], $exteriorimg);
}endif;

$floormats = $_REQUEST['floormats'];

$floormatsnotes = mysqli_real_escape_string($conn,$_REQUEST['floormatsnotes']);

if((isset($_FILES['floormatsimg']['name']) && ($_FILES['floormatsimg']['size'] > 0))): {
$floormatsimg = $target_directory . uniqid(). $_FILES['floormatsimg']['name'];
move_uploaded_file($_FILES['floormatsimg']['tmp_name'], $floormatsimg);
}endif;

$pedalscheck = $_REQUEST['pedalscheck'];

$pedalschecknotes  = mysqli_real_escape_string($conn,$_REQUEST['pedalschecknotes']);

if((isset($_FILES['pedalscheckimg']['name']) && ($_FILES['pedalscheckimg']['size'] > 0))): {
$pedalscheckimg = $target_directory . uniqid(). $_FILES['pedalscheckimg']['name'];
move_uploaded_file($_FILES['pedalscheckimg']['tmp_name'], $pedalscheckimg);
}endif;

$brakepedal = $_REQUEST['brakepedal'];

$brakepedalnotes = mysqli_real_escape_string($conn,$_REQUEST['brakepedalnotes']);

if((isset($_FILES['brakepedalimg']['name']) && ($_FILES['brakepedalimg']['size'] > 0))): {
$brakepedalimg = $target_directory . uniqid(). $_FILES['brakepedalimg']['name'];
move_uploaded_file($_FILES['brakepedalimg']['tmp_name'], $brakepedalimg);
}endif;

$steering  = $_REQUEST['steering'];

$steeringnotes = mysqli_real_escape_string($conn,$_REQUEST['steeringnotes']);

if((isset($_FILES['steeringimg']['name']) && ($_FILES['steeringimg']['size'] > 0))): {
$steeringimg = $target_directory . uniqid(). $_FILES['steeringimg']['name'];
move_uploaded_file($_FILES['steeringimg']['tmp_name'], $steeringimg);
}endif;

$gearselector  = $_REQUEST['gearselector'];

$gearselectornotes = mysqli_real_escape_string($conn,$_REQUEST['gearselectornotes']);

if((isset($_FILES['gearselectorimg']['name']) && ($_FILES['gearselectorimg']['size'] > 0))): {
$gearselectorimg = $target_directory . uniqid(). $_FILES['gearselectorimg']['name'];
move_uploaded_file($_FILES['gearselectorimg']['tmp_name'], $gearselectorimg);
}endif;

$seat  = $_REQUEST['seat'];

$seatnotes = mysqli_real_escape_string($conn,$_REQUEST['seatnotes']);

if((isset($_FILES['seatimg']['name']) && ($_FILES['seatimg']['size'] > 0))): {
$seatimg = $target_directory . uniqid(). $_FILES['seatimg']['name'];
move_uploaded_file($_FILES['seatimg']['tmp_name'], $seatimg);
}endif;

$seatbelt  = $_REQUEST['seatbelt'];

$seatbeltnotes = mysqli_real_escape_string($conn,$_REQUEST['seatbeltnotes']);

if((isset($_FILES['seatbeltimg']['name']) && ($_FILES['seatbeltimg']['size'] > 0))): {
$seatbeltimg = $target_directory . uniqid(). $_FILES['seatbeltimg']['name'];
move_uploaded_file($_FILES['seatbeltimg']['tmp_name'], $seatbeltimg);
}endif;

$camerascheck  = $_REQUEST['camerascheck'];

$cameraschecknotes = mysqli_real_escape_string($conn,$_REQUEST['cameraschecknotes']);

if((isset($_FILES['camerascheckimg']['name']) && ($_FILES['camerascheckimg']['size'] > 0))): {
$camerascheckimg = $target_directory . uniqid(). $_FILES['camerascheckimg']['name'];
move_uploaded_file($_FILES['camerascheckimg']['tmp_name'], $camerascheckimg);
}endif;

if((isset($_FILES['interiorimg']['name']) && ($_FILES['interiorimg']['size'] > 0))): {
$interiorimg = $target_directory . uniqid(). $_FILES['interiorimg']['name'];
move_uploaded_file($_FILES['interiorimg']['tmp_name'], $interiorimg);
}endif;

$battery = $_REQUEST['battery'];

$batterynotes  = mysqli_real_escape_string($conn,$_REQUEST['batterynotes']);

if((isset($_FILES['batteryimg']['name']) && ($_FILES['batteryimg']['size'] > 0))): {
$batteryimg = $target_directory . uniqid(). $_FILES['batteryimg']['name'];
move_uploaded_file($_FILES['batteryimg']['tmp_name'], $batteryimg);
}endif;

$airintake = $_REQUEST['airintake'];

$airintakenotes = mysqli_real_escape_string($conn,$_REQUEST['airintakenotes']);

if((isset($_FILES['airintakeimg']['name']) && ($_FILES['airintakeimg']['size'] > 0))): {
$airintakeimg = $target_directory . uniqid(). $_FILES['airintakeimg']['name'];
move_uploaded_file($_FILES['airintakeimg']['tmp_name'], $airintakeimg);
}endif;

$throttlecable = $_REQUEST['throttlecable'];

$throttlecablenotes = mysqli_real_escape_string($conn,$_REQUEST['throttlecablenotes']);

if((isset($_FILES['throttlecableimg']['name']) && ($_FILES['throttlecableimg']['size'] > 0))): {
$throttlecableimg = $target_directory . uniqid(). $_FILES['throttlecableimg']['name'];
move_uploaded_file($_FILES['throttlecableimg']['tmp_name'], $throttlecableimg);
}endif;

$fluidcaps = $_REQUEST['fluidcaps'];

$fluidcapsnotes = mysqli_real_escape_string($conn,$_REQUEST['fluidcapsnotes']);

if((isset($_FILES['fluidcapsimg']['name']) && ($_FILES['fluidcapsimg']['size'] > 0))): {
$fluidcapsimg = $target_directory . uniqid(). $_FILES['fluidcapsimg']['name'];
move_uploaded_file($_FILES['fluidcapsimg']['tmp_name'], $fluidcapsimg);
}endif;

$leakcheck = $_REQUEST['leakcheck'];

$leakchecknotes = mysqli_real_escape_string($conn,$_REQUEST['leakchecknotes']);

if((isset($_FILES['leakcheckimg']['name']) && ($_FILES['leakcheckimg']['size'] > 0))): {
$leakcheckimg = $target_directory . uniqid(). $_FILES['leakcheckimg']['name'];
move_uploaded_file($_FILES['leakcheckimg']['tmp_name'], $leakcheckimg);
}endif;

$trunk = $_REQUEST['trunk'];

$trunknotes = mysqli_real_escape_string($conn,$_REQUEST['trunknotes']);

if((isset($_FILES['trunkimg']['name']) && ($_FILES['trunkimg']['size'] > 0))): {
$trunkimg = $target_directory . uniqid(). $_FILES['trunkimg']['name'];
move_uploaded_file($_FILES['trunkimg']['tmp_name'], $trunkimg);
}endif;

$exhaust = $_REQUEST['exhaust'];

$exhaustnotes  = mysqli_real_escape_string($conn,$_REQUEST['exhaustnotes']);

if((isset($_FILES['exhaustimg']['name']) && ($_FILES['exhaustimg']['size'] > 0))): {
$exhaustimg = $target_directory . uniqid(). $_FILES['exhaustimg']['name'];
move_uploaded_file($_FILES['exhaustimg']['tmp_name'], $exhaustimg);
}endif;

if((isset($_FILES['hoodimg']['name']) && ($_FILES['hoodimg']['size'] > 0))): {
$hoodimg = $target_directory . uniqid(). $_FILES['hoodimg']['name'];
move_uploaded_file($_FILES['hoodimg']['tmp_name'], $hoodimg);
}endif;

$signature_pad = $_REQUEST['signature_image'];


//Insert values into the DB
$sql = "INSERT INTO form_table (account_id,car_id,annualinspect,form_date,wheelbearings,wheelbearingsnotes,wheelbearingsimg,
wheelcheck,wheelchecknotes,wheelcheckimg,hubcaps,hubcapsnotes,hubcapsimg,tirecheck,tirechecknotes,tirecheckimg,tiretreads,
tiretreadsnotes,tiretreadsimg,brakecheck,brakechecknotes,brakecheckimg,bodypanels,bodypanelsnotes,bodypanelsimg,numbers,
numbersnotes,numbersimg,exteriorimg,floormats,floormatsnotes,floormatsimg,pedalscheck,pedalschecknotes,pedalscheckimg,
brakepedal,brakepedalnotes,brakepedalimg,steering,steeringnotes,steeringimg,gearselector,gearselectornotes,gearselectorimg,
seat,seatnotes,seatimg,seatbelt,seatbeltnotes,seatbeltimg,camerascheck,cameraschecknotes,camerascheckimg,interiorimg,
battery,batterynotes,batteryimg,airintake,airintakenotes,airintakeimg,throttlecable,throttlecablenotes,throttlecableimg,
fluidcaps,fluidcapsnotes,fluidcapsimg,leakcheck,leakchecknotes,leakcheckimg,trunk,trunknotes,trunkimg,exhaust,
exhaustnotes,exhaustimg,hoodimg,signature_pad) VALUES 
    ('$account_id','$garageselector','$annualinspect','$form_date','$wheelbearings','$wheelbearingsnotes','$wheelbearingsimg',
    '$wheelcheck','$wheelchecknotes','$wheelcheckimg','$hubcaps','$hubcapsnotes','$hubcapsimg','$tirecheck',
    '$tirechecknotes','$tirecheckimg','$tiretreads','$tiretreadsnotes','$tiretreadsimg','$brakecheck','$brakechecknotes',
    '$brakecheckimg','$bodypanels','$bodypanelsnotes','$bodypanelsimg','$numbers','$numbersnotes','$numbersimg',
    '$exteriorimg','$floormats','$floormatsnotes','$floormatsimg','$pedalscheck','$pedalschecknotes','$pedalscheckimg',
    '$brakepedal','$brakepedalnotes','$brakepedalimg','$steering','$steeringnotes','$steeringimg','$gearselector',
    '$gearselectornotes','$gearselectorimg','$seat','$seatnotes','$seatimg','$seatbelt','$seatbeltnotes',
    '$seatbeltimg','$camerascheck','$cameraschecknotes','$camerascheckimg','$interiorimg','$battery','$batterynotes',
    '$batteryimg','$airintake','$airintakenotes','$airintakeimg','$throttlecable','$throttlecablenotes','$throttlecableimg',
    '$fluidcaps','$fluidcapsnotes','$fluidcapsimg','$leakcheck','$leakchecknotes','$leakcheckimg','$trunk','$trunknotes',
    '$trunkimg','$exhaust','$exhaustnotes','$exhaustimg','$hoodimg','$signature_pad');";

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
