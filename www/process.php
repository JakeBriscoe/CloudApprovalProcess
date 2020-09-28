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

      $db_host   = '192.168.2.12';
      $db_name   = 'fvision';
      $db_user   = 'webuser';
      $db_passwd = 'insecure_db_pw';
      $pdo_dsn = "mysql:host=$db_host;dbname=$db_name";
      $pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

      // If customising the database, the insert statement and variables will need to be altered accordingly.

      $fname = $_POST["fname"];
      $lname = $_POST["lname"];
      $email = $_POST["email"];
      $description = $_POST["description"];

      $stmt = $pdo->prepare("INSERT INTO requests (fname, lname, email, description) VALUES (?,?,?,?)");
      $stmt->execute([$fname, $lname, $email, $description]);
    ?>

  </div>

</body>
</html>
