<?php
include("connection.php");
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="/libraryM/css/dashboard.css">
</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <a href="#dashboard"  class="sidebar-link">Dashboard</a>
    <a href="#books" class="sidebar-link">Books</a>
    <a href="#">Logout</a>
  </div>

  <!-- Dashboard content -->
  <div class="content" id="dashboard">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <h4 class="m-0">List of Students</h4>
      </div>
    </div>

    <div class="container mt-4">
      <table class="table table-bordered table-hover">
        <thead class="table-header">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $res = mysqli_query($conn, "SELECT * FROM `user`;");
          while ($row = mysqli_fetch_assoc($res)) {
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['name'] ?></td>
              <td><?= $row['email'] ?></td>
              <td><?= $row['password'] ?></td>
              <td>
                <form action="function.php" method="post">
                  <input type="hidden" name="id" value="<?= $row['id'] ?>">
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                </form>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Books content -->
  <div class="content" id="books">
    <!-- List of books -->
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <h4 class="m-0">List of Books</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookModal">Add Books</button>
      </div>
    </div>
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addBookModalLabel">Add Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form for adding books -->
        <form action="function.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="bookName" class="form-label">Book Name</label>
            <input type="text" class="form-control" id="bookName" name="name" required>
          </div>
          <div class="mb-3">
            <label for="bookAuthor" class="form-label">Author</label>
            <input type="text" class="form-control" id="bookAuthor" name="author" required>
          </div>
          <div class="mb-3">
            <label for="bookEdition" class="form-label">Edition</label>
            <input type="text" class="form-control" id="bookEdition" name="edition" required>
          </div>
          <div class="mb-3">
            <label for="bookStatus" class="form-label">Status</label>
            <input type="text" class="form-control" id="bookStatus" name="status" required>
          </div>
          <div class="mb-3">
            <label for="bookQuantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="bookQuantity" name="quantity" required>
          </div>
          <div class="mb-3">
            <label for="bookDepartment" class="form-label">Department</label>
            <input type="text" class="form-control" id="bookDepartment" name="department" required>
          </div>
          <div class="mb-3">
            <label for="bookImage" class="form-label">Book Image</label>
            <input type="file" class="form-control" id="bookImage" name="book_image" accept="image/jpeg, image/png" required>
          </div>
          <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Table -->
    <div class="container mt-4">
      <table class="table table-bordered table-hover">
        <!-- Table header -->
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
          </tr>
        </thead>
        <!-- Table body -->
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
             <td><img src="<?= $row['image_path'] ?>" alt="Book Image"  style="max-width: 100px; height: auto";></td>

            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>



<script src="/libraryM/js/app.js"></script>
</body>
</html>
