<?php 
 include("config.php");
 session_start();

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM user WHERE email='$email'";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);

  if ($count == 1) {
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row['password'])) {
          $_SESSION['email'] = $email;
          header("location: home.php"); // Redirect to the home page after successful login
      } else {
          echo '<script>
              alert("Incorrect password");
              window.location.href = "index.php";
          </script>';
      }
  } else {
      echo '<script>
          alert("Email not registered");
          window.location.href = "index.php";
      </script>';
  }
}

// Register
if(isset($_POST['Submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $sql="SELECT * FROM user WHERE name='$name'";
    $result = mysqli_query($conn, $sql);
    $count_name = mysqli_num_rows($result);

    $sql="SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $count_email = mysqli_num_rows($result);

    if($count_name == 0 & $count_email==0){
      if($password==$cpassword){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $result = "INSERT INTO user (name, email, password)
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
            window.location.href="index.php";
            alert("Username already exists!!");
        </script>';
      }
      if($count_email>0){
        echo '<script>
            window.location.href="index.php";
            alert("Email already exists!!");
        </script>';
      }
    }
  }


// Define paths for admin and user directories

$adminDir = '/xampp/htdocs/LibraryM/admin/uploads/';
$userDir = '/xampp/htdocs/LibraryM/user/uploads/';

// Check if the admin directory exists
if (is_dir($adminDir)) {
    // Get a list of all files in the admin directory
    $files = scandir($adminDir);

    // Ensure scandir was successful
    if ($files !== false) {
        // Loop through each file in the admin directory
        foreach ($files as $file) {
            // Skip . and .. directories
            if ($file == '.' || $file == '..') {
                continue;
            }
            
            // Build full paths for the source and destination files
            $sourceFile = $adminDir . $file;
            $destinationFile = $userDir . $file;

            // Move the file from the admin directory to the user directory
            if (rename($sourceFile, $destinationFile)) {
                echo "File $file moved successfully.<br>";
            } else {
                echo "Error moving file $file.<br>";
            }
        }
    } else {
        echo "Failed to list files in the admin directory.";
    }
} else {
    echo "Admin directory not found.";
}



// Check if the form is submitted and the "borrow" button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["borrow"])) {
  // Get the borrower ID from the session
  $borrowerId = $_SESSION["id"];

  // Get the book ID from the session
  $bookId = $_SESSION["bid"];

  // Fetch the book name from the database based on the book ID
  $bookNameQuery = "SELECT * FROM books WHERE bid = '$bookId'";
  $bookNameResult = mysqli_query($conn, $bookNameQuery);

  if ($bookNameResult === false) {
      // Handle query execution error
      echo "Error executing query: " . mysqli_error($conn);
  } else {
      if (mysqli_num_rows($bookNameResult) > 0) {
          // Fetch the result set and access array offsets
          $row = mysqli_fetch_assoc($bookNameResult);
          $bookName = $row['name'];

          // Fetch the user name from the user database based on the user ID
          $userNameQuery = "SELECT * FROM user WHERE id ='$borrowerId'";
          $userNameResult = mysqli_query($conn, $userNameQuery);

          // Check if the user name is found
          if ($userNameResult && mysqli_num_rows($userNameResult) > 0) {
              $row = mysqli_fetch_assoc($userNameResult);
              $userName = $row['name'];

              // Get the current date and time
              $borrowedTime = date('Y-m-d H:i:s');

              // Insert borrowed book information into the database
              $sql = "INSERT INTO borrow (id, book_name, user_name, date) 
                      VALUES ('$borrowerId', '$bookName', '$userName', '$borrowedTime')";

              // Execute the query
              if (mysqli_query($conn, $sql)) {
                  // Redirect to the borrowed page
                  header("Location: borrowed.php");
                  exit; // Stop further execution
              } else {
                  echo "Failed to borrow the book: " . mysqli_error($conn);
              }
          } else {
              echo "User not found.";
          }
      } else {
          echo "Book not found.";
      }
  }
}


?>


