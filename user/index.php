<!DOCTYPE html>
<html>
<head>
<title>Request</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


  <div class="container">
    <h1>Make a Request</h1>
    <p>Please fill in this form to submit a request.</p><br>
    <div class="input">
    <form action="process.php" method="post" name='submitForm'>
    <hr>
      <!-- The below labels and inputs can be customised as required -->
      <label for="fname">First name:</label><br>
      <input type="text" id="fname" name="fname" required><br>
      <label for="lname">Last name:</label><br>
      <input type="text" id="lname" name="lname" required><br>
      <label for="email">Email:</label><br>
      <input type="text" id="email" name="email" required><br>
      <label for="description">Description:</label><br>
      <input type="text" id="description" name="description" required><br><br>
    </hr>
    <button type="submit" class="registerbtn">Submit</button>
    </form>
    </div>
  </div>
</body>
</html>
