<?php
include("config.php");
session_start(); // Start the session
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="/library/css/style.css">
</head>
<body>
  <div class="container">
    <div class="box form-box">
      <header>User Login</header>
      <form action="code.php" method="POST">
        <div class="field input">
          <label for="username">Email</label>
          <input type="email" name="email" id="email" required autocomplete="off">
        </div>

        <div class="field input">
          <label for="username">Password</label>
          <input type="password" name="password" id="password" required autocomplete="off">
        </div>

        <div class="field">
          <input type="submit" class="btn" name="submit" value="Login" required>
        </div>
        <div class="links">
          Don't have account? <a href="register.php">Signup</a>
        </div>
      </form>
    </div>
  </div>
  
</body>
</html>