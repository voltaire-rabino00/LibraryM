<?php
include("config.php");
session_start(); // Start the session

// Fetch borrowed books data from the database
$sql = "SELECT id, book_name, user_name, date FROM borrow";
$result = mysqli_query($conn, $sql);

// Check if query executed successfully
if ($result) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Borrowed Books</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Add custom styles here */
  </style>
</head>
<body>
<div class="container">
  <h1 class="text-center mt-5 mb-4">Borrowed Books</h1>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Book Name</th>
        <th>User Name</th>
        <th>Borrowed Time</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Display each borrowed book as a table row
        while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['book_name']; ?></td>
        <td><?php echo $row['user_name']; ?></td>
        <td><?php echo $row['date']; ?></td>
        <td>
                <form action="code.php" method="post">
                  <input type="hidden" name="id" value="<?= $row['id'] ?>">
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to return thi book?')">Return</button>
                </form>
              </td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>

<?php
} else {
    // Display an error message if the query fails
    echo "Failed to fetch borrowed books: " . mysqli_error($conn);
}
?>
