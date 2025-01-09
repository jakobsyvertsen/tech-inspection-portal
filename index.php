<!--Written by Jakob Syvertsen-->
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>"></link>
</head>

<body>




<?php
    //Session information
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "Group2CCSCC202$";
    $dbname = "techinspection";
    $con = mysqli_connect($servername, $username, $password, $dbname);

    //Value that controls how many rows are displayed on each page of index table
    $rows_to_fetch = 25;
    //set offset for main index page
    if (!isset($_GET['offset']) or ! is_numeric($_GET['offset'])) {
      $offset = 0;
    }
    //offset to fetch proper DB values
    else {
      $offset = $_GET['offset'];
    }

    $id = $_SESSION['account_id'];

    //Only show their forms if they are an owner, else show all forms
    if ($_SESSION["role_descriptor"] === 'Owner'){
      
      $result = mysqli_query($con,"SELECT form_id, form_date, account_id, car_id FROM form_table WHERE account_id='$id' ORDER BY form_date DESC LIMIT $offset, $rows_to_fetch");
    }
    else {
      $result = mysqli_query($con,"SELECT form_id, form_date, account_id, car_id FROM form_table ORDER BY form_date DESC LIMIT $offset, $rows_to_fetch");
    }
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $row_count = count($data);
?>

<div class="page-wrapper">
<header class="header-wrapper">
  <a href="index.php" class="header-link">Menu</a>
  <a href="techform.php" class="header-link">Tech Inspection Form</a>
  <a href="account.php?id=<?php echo $_SESSION["account_id"]; ?>" class="header-link" style="margin-left: auto;">Account</a>
  <a href="login.html" class="header-link">Logout</a>
</header>
<table>
    <tr>
      <th>Car</th>
      <th>Account Name</th>
      <th>Date</th>
    </tr>
    <!--PHP loop to generate rows in table-->
    <?php if (mysqli_num_rows($result)!==0): ?>
    <?php foreach($data as $row): ?>
    <?php
      $account = $row["account_id"];
      $account_result = mysqli_query($con,"SELECT first_name, last_name FROM users WHERE id='$account'");
      $account_data = $account_result->fetch_assoc();
      $garage = $row["car_id"];
      $garage_result = mysqli_query($con,"SELECT car_year, car_make, car_model, car_color FROM garage_table WHERE car_id='$garage'");
      $garage_data = $garage_result->fetch_assoc();
    ?>
      <?php
      //If user is admin, display form ID in table
        if($_SESSION['role_descriptor'] == 'Admin'){ 
      ?>
      <td><?= "<a href='techform.php?id=" . $row["form_id"] . "'>" . htmlspecialchars( $row["form_id"] . "— " . $garage_data["car_year"] . " " . $garage_data["car_make"] . " " . $garage_data["car_model"] . ", " . $garage_data["car_color"]) . "</a>" ?></td>
      <?php
        } else {
      ?>
      <td><?= "<a href='techform.php?id=" . $row["form_id"] . "'>" . htmlspecialchars($garage_data["car_year"] . " " . $garage_data["car_make"] . " " . $garage_data["car_model"] . ", " . $garage_data["car_color"]) . "</a>" ?></td>
      <?php } ?>
      <td><?= htmlspecialchars($account_data["first_name"]) . " " . htmlspecialchars($account_data["last_name"]) ?></td>
      <td><?= htmlspecialchars(date('F d, Y h:i:s A',strtotime($row['form_date']))) ?> </td>
      <td style="position: relative">
        <form method="POST" action="delete.php" onsubmit="confirmDeletion(event)">
          <input type="hidden" name="row_id" value="<?php echo $row['form_id']; ?>">
          <input type="image" name="delete" src="src/delete-trash-can.svg" onmouseover="this.src='src/delete-trash-can-hover.svg';" onmouseout="this.src='src/delete-trash-can.svg';" border="0" alt="Delete" value="Delete" class="table-submit"
          <?php
              $disabled = '';
              //Disable delete button for forms older than
              //one day if not an Admin
              if($_SESSION['role_descriptor'] !== 'Admin'): {
                if (date("Y-m-d H:i:s", strtotime('-1 day')) > $row['form_date']): {
                  $disabled = 'disabled';
                }endif;
                if ($account !== $_SESSION['account_id']): {
                  $disabled = 'disabled';
                }endif;
              }endif;
              echo $disabled;
          ?>
          >
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>
<?php 
      //PHP code for next/back buttons
      $prev = $offset - $rows_to_fetch;
      if ($row_count >= $rows_to_fetch): {
        echo '<a href="' . $_SERVER['PHP_SELF'] . '?offset=' . ($offset + $rows_to_fetch) . '" class="table-button" style="float: right;">Next</a>';
      }endif;
      if ($prev >= 0): {
        echo '<a href="' . $_SERVER['PHP_SELF'] . '?offset=' . $prev . '"class="table-button">Previous</a>';
      }endif;
?>
</div>
</body>

<script>
  //Delete function for table
  function confirmDeletion(event) {
    if (!confirm("Are you sure you would like to delete this inspection?")) {
      event.preventDefault();
    }
  }
</script>

</html>

<?php mysqli_close( $con ); ?>
