<?php
 include("connection.php");
 session_start();
// Register
if(isset($_POST['Submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  $sql="SELECT * FROM admin WHERE name='$name'";
  $result = mysqli_query($conn, $sql);
  $count_name = mysqli_num_rows($result);

  $sql="SELECT * FROM admin WHERE email='$email'";
  $result = mysqli_query($conn, $sql);
  $count_email = mysqli_num_rows($result);

  if($count_name == 0 & $count_email==0){
    if($password==$cpassword){
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $result = "INSERT INTO admin (name, email, password)
      VALUES('$name', '$email', '$hash')";
      $result = mysqli_query($conn, $result);
      
      if ($result) {
        $_SESSION['registration_success'] = true;
        header("location: index.php");
    }
    }
    else{
      echo '<script>
        alert("Password Do not match");
        window.location.href = "index.php";
      </script>';
    }
  }
  else{

    if($count_name>0){
      echo '<script>
          window.location.href="admin.php";
          alert("Username already exists!!");
      </script>';
    }
    if($count_email>0){
      echo '<script>
          window.location.href="admin.php";
          alert("Email already exists!!");
      </script>';
    }
  }
}

// LOgin function

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM admin WHERE email='$email'";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);

  if ($count == 1) {
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row['password'])) {
          $_SESSION['email'] = $email;
          header("location: dashboard.php"); // Redirect to the home page after successful login
      } else {
          echo '<script>
              alert("Incorrect password");
              window.location.href = "admin.php";
          </script>';
      }
  } else {
      echo '<script>
          alert("Email not registered");
          window.location.href = "admin.php";
      </script>';
  }
}


// Delete Function
if(isset($_POST['id'])) {
  $id = $_POST['id'];
  
  // Perform the deletion query
  $sql = "DELETE FROM user WHERE id = $id";
  if(mysqli_query($conn, $sql)) {
      echo '<script>
          alert("User Successfully Deleted");
          window.location.href = "dashboard.php";
      </script>';
  } else {
      echo "Error deleting user: " . mysqli_error($conn);
  }
}



// Adding Books
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve and sanitize form data
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $author = mysqli_real_escape_string($conn, $_POST['author']);
  $edition = mysqli_real_escape_string($conn, $_POST['edition']);
  $status = mysqli_real_escape_string($conn, $_POST['status']);
  $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
  $department = mysqli_real_escape_string($conn, $_POST['department']);

  // File upload handling
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["book_image"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  

  // Check if the form was submitted
  if (isset($_POST["submit"])) {
    // Check if file is an actual image
    $check = getimagesize($_FILES["book_image"]["tmp_name"]);
    if ($check !== false) {
      // File is an image
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Check file size
  if ($_FILES["book_image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if ($imageFileType != "jpg" && $imageFileType != "png") {
    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
    $uploadOk = 0;
  }

  $uploadOk = 1; // Initialize $uploadOk with a default value

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["book_image"]["tmp_name"], $target_file)) {
      // File uploaded successfully
      // Insert book into the database
      $sql = "INSERT INTO books (name, authors, edition, status, quantity, department, image_path)
              VALUES ('$name', '$author', '$edition', '$status', '$quantity', '$department', '$target_file')";

      if (mysqli_query($conn, $sql)) {
        echo "Book added successfully.";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}

?>