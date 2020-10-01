<!DOCTYPE html>
<html>
<head>
<title>Request</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


  <div class="container">

    <h1>Thank You!</h1>
    <p>You will recieve a response within 5 working days.</p><br>

    <?php

      $db_user = 'master';
      $db_passwd = 'HappenGreatStandLearnVery';
      $db_name = 'approvaldb';
      $db_host = 'approval-database.ccuflugukunx.us-east-1.rds.amazonaws.com';

      $connection = mysqli_connect($db_host, $db_user, $db_passwd);
      if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
      $database = mysqli_select_db($connection, $db_name);

      // If customising the database, the insert statement and variables will need to be altered accordingly.

      $fname = mysqli_real_escape_string($connection, $_POST["fname"]);
      $lname = mysqli_real_escape_string($connection, $_POST["lname"]);
      $email = mysqli_real_escape_string($connection, $_POST["email"]);
      $description = mysqli_real_escape_string($connection, $_POST["description"]);

      $query = "INSERT INTO requests (fname, lname, email, description) VALUES ($fname, $lname, $email, $description);";
      if(!mysqli_query($connection, $query)) echo("<p>Error adding request.</p>");
    ?>

  </div>

</body>
</html>
