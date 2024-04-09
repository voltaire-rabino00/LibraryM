<?php
  include("connection.php");
  session_start(); 
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link rel="stylesheet" href="/library/css/style.css">
</head>
<body>
  <div class="container">
    <div class="box form-box">
      <header>Admin Signup</header>
      <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>
      <form action="function.php" method="POST">
        <div class="field input">
          <label for="username">Name</label>
          <input type="text" name="name" id="name" autocomplete="off" required>
        </div>

        <div class="field input">
          <label for="username">Email</label>
          <input type="email" name="email" id="email" autocomplete="off" required>
        </div>

        <div class="field input">
          <label for="username">Password</label>
          <input type="password" name="password" id="password" autocomplete="off" required>
        </div>

        <div class="field input">
          <label for="username"> Confirm Password</label>
          <input type="password" name="cpassword" id="cpassword" autocomplete="off" required>
        </div>

        <div class="field">
          <input type="submit" class="btn" name="Submit" value="Register" required>
        </div>
        <div class="links">
          Already have an account? <a href="admin.php">Login</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>