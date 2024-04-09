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
$adminDir = '/path/to/admin/uploads/';
$userDir = '/path/to/user/uploads/';

// Get a list of all files in the admin directory
$files = scandir($adminDir);

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
?>

?>