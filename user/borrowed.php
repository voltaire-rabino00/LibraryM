<?php
include("config.php");
session_start(); // Start the session

// Initialize $borrowId variable from session if it exists
if (isset($_SESSION["id"])) {
    $borrowId = $_SESSION["id"];
} else {
    // Handle the case where the user ID is not set in the session
    // Redirect the user or display an error message
    exit("User ID not found.");
}

function borrowBook($conn, $bookId, $borrowId) {
    // Insert a new row into the borrow table
    $borrowedTime = date('Y-m-d H:i:s');
    $sql = "INSERT INTO borrow (bid, id, date) 
            VALUES ('$bookId', '$borrowId', '$borrowedTime')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Borrow button form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["borrow"])) {
    $bookId = $_POST["bid"]; // Get the book ID from the form
    if (borrowBook($conn, $bookId, $borrowId)) {
        echo "Book borrowed successfully.";
    } else {
        echo "Failed to borrow the book.";
    }
}

// Display borrowed books
$res = mysqli_query($conn, "SELECT * FROM borrow WHERE id = '$borrowId'");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Borrowed</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="/libraryM/css/books.css">
</head>
<body>
<table class="table">
    <thead>
        <tr>
            <th>Book ID</th>
            <th>Book Name</th>
            <th>Borrowed Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch and display borrowed books
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>";
            echo "<td>{$row['book_id']}</td>";
            echo "<td>{$row['book_name']}</td>"; // Display the book name
            echo "<td>{$row['borrowed_time']}</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>