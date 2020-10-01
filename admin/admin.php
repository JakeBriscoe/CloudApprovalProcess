<!DOCTYPE html>
<html>
<head>
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

  <?php

  // Connect to database
  $db_user = 'master';
  $db_passwd = 'HappenGreatStandLearnVery';
  $db_name = 'approvaldb';
  $db_host = 'approval-database.ccuflugukunx.us-east-1.rds.amazonaws.com';

  $pdo_dsn = "mysql:host=$db_host;dbname=$db_name";
  $pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

  // Alter status
  // An email function could be called inside each of these if statements
  if( isset( $_POST['accept'] ) ) {
    $did = $_POST['id'];
    $stmt = $pdo->prepare("UPDATE requests SET status='Approved' WHERE request_id=?");
    $stmt->execute([$did]);
  } else if ( isset($_POST['reject']) ) {
      $did = $_POST['id'];
      $stmt = $pdo->prepare("UPDATE requests SET status='Rejected' WHERE request_id=?");
      $stmt->execute([$did]);
  }

  // Get all pending requests
  $q = $pdo->query("SELECT * FROM requests WHERE status='Pending'");

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
