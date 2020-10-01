<!DOCTYPE html>
<html>
<head>
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

  <?php

  $db_user = 'master';
  $db_passwd = 'HappenGreatStandLearnVery';
  $db_name = 'approvaldb';
  $db_host = 'approval-database.ccuflugukunx.us-east-1.rds.amazonaws.com';

  $connection = mysqli_connect($db_host, $db_user, $db_passwd);
  $database = mysqli_select_db($connection, $db_name);

  // Alter status
  // An email function could be called inside each of these if statements
  if( isset( $_POST['accept'] ) ) {
    $did = $_POST['id'];
    $query = "UPDATE requests SET status='Approved' WHERE request_id=$did;";
    if(!mysqli_query($connection, $query)) echo("<p>Error accepting request.</p>");
  } else if ( isset($_POST['reject']) ) {
      $did = $_POST['id'];
      $query = "UPDATE requests SET status='Rejected' WHERE request_id=$did;";
      if(!mysqli_query($connection, $query)) echo("<p>Error rejecting request.</p>");
  }

  // Get all pending requests
  $result = mysqli_query($connection, "SELECT * FROM requests WHERE status='Pending'");

  ?>

  <div class="container">
    <h1>Pending Applications</h1>
    <div class="align">
    <hr>
      <?php

        while($row = $q->fetch()){

          // If customising to fit your purpose, these attributes will need to match your database.
          echo "<h3>".$row["fname"]."</h3>";
          echo "<p>Time of submission: ".$row["submission_time"]."</p>";
          echo "<p>".$row["email"]."</p><br>";
          echo "<p>".$row["description"]."</p><br>";

          echo "<form method='POST'>
                <input type=hidden name=id value=".$row["request_id"]." >
                <button type='submit' class='accept' name='accept'>Accept</button><br>
                </form>";
          echo "<form method='POST'>
                <input type=hidden name=id value=".$row["request_id"]." >
                <button type=submit class='reject' name=reject>Reject</button><br><br><br>
                </form>";
        }

      ?>
    </hr>
    </div>
  </div>
</body>
</html>
