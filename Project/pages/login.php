<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../connection/connect.php';

    // Sanitize and retrieve username and password from the form
    $myusername = mysqli_real_escape_string($conn, $_POST['username']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

    // Query the database to check if the provided credentials are valid
    // $sql = "SELECT id FROM login WHERE username = '$myusername' and password = '$mypassword'";
    $sql = "CALL User_login ('$myusername','$mypassword')";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row
      if ($count == 1) {
        $_SESSION['login_user'] = $myusername; // Set session variable
        header("location: main.php"); // Redirect to main.php
    }else if($count < 0){
      echo '<script>alert("Please Enter Username or Password");</script>'; // Show alert for incorrect credentials
     }else {
        echo '<script>alert("Incorrect username or password");</script>'; // Show alert for incorrect credentials
    }
    


  // $userlogname =mysqli_real_escape_string($conn, $_POST["userName"]) ;
  // $password = mysqli_real_escape_string($conn, $_POST["pass_  word"]) ;

  // $sql = "CALL User_login ($userlogname,$password)";
  // $result = mysqli_query($conn, $sql);
  // $row = mysqli_num_rows($result);

  // if($row["user_level_fk"== 1]){
  //   echo "admin";
  // }elseif($row["user_level_fk"== 2]){
  //   echo "staff";
  // } 
    // Close the database connection
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

</head>
<body>
    <form class="login container-fluid" action="login.php" method="POST" id="login-user">
        <div class="form">
            <div class="mb-3">
                <div class="form-header"><h1 class="text-center mb-3">Login Form</h1></div>
              <label for="exampleInputEmail1" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1" >
              <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
            <div class="bottom-but w-100 d-flex align-content-center justify-content-center">
                <button class="btn btn-primary mt-2" type="submit" value="login">SIGN IN</button>
            </div>
        </div>
      </form>

</body>

<script src="../js/bootstrap.min.js"></script>
<script src="../js/style.js"></script>
</html>