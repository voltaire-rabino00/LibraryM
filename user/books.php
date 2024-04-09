<?php
include("config.php");
session_start(); // Start the session

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Books</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="/library/css/books.css">
</head>

<body>

<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="m-0">List of Books</h4>
        <div>
            <a href="/library/user/home.php" class="btn btn-primary me-2">Back</a>
            <a href="/library/user/borrowed.php" class="btn btn-success">Borrowed</a> 
        </div>
    </div>
</div>


<div class="container mt-4">
    <div class="table-responsive"> <!-- Add the table-responsive class -->
        <table class="table table-bordered table-hover">
            <thead class="table-header">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Authors</th>
                    <th>Edition</th>
                    <th>Status</th>
                    <th>Quantity</th>
                    <th>Department</th>
                    <th>Image</th>
                    <th>Action</th> <!-- New column for the Borrow button -->
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($conn, "SELECT * FROM `books`;");
                while ($row = mysqli_fetch_assoc($res)) {

                ?>
                    <tr>
                        <td><?= $row['bid'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['authors'] ?></td>
                        <td><?= $row['edition'] ?></td>
                        <td><?= $row['status'] ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td><?= $row['department'] ?></td>
                        <td><img src="<?= $row['image_path'] ?>" alt="Book Image" style="max-width: 100px; height: auto";></td>
                        <td><button class="btn btn-success">Borrow</button></td> <!-- Borrow button -->
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

</body>
</html>
