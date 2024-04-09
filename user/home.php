<?php
include("config.php");
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Management System</title>
  <link rel="stylesheet" href="/library/css/home.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>

  <section id="navbar">
    <nav>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="/library/user/books.php">Books</a></li>
        <li><a href="#contact">Logout</a></li>
      </ul>
    </nav>
  </section>

  <section class="hero-section">
        <div class="container">
            <h1>Welcome to Library Management System</h1>
            <p>Manage your library efficiently with our easy-to-use system.</p>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Library Management System. All rights reserved.</p>
        </div>
    </footer>
    
  </section>



  <script src="scripts.js"></script>
</body>

</html>


