
<?php
include '../connection/connect.php';

  // Handling form submission for creating a new user
  if(isset($_POST['submit_user'])) {
    // Retrieve form data
    $user_full_name = $conn->real_escape_string($_POST['user_full_name']);
    $user_log_name = $conn->real_escape_string($_POST['user_log_name']);
    $user_log_password = $conn->real_escape_string($_POST['user_log_password']);
    $user_level_fk = intval($_POST['user_level_fk']);
    $department_pk =intval($_POST['user_department_fk']);
  
    // Insert user into the database
    $sql = "CALL Insert_User('$user_full_name', '$user_log_name', '$user_log_password', '$user_level_fk', '$department_pk')";
    $stmt = $conn->prepare($sql);
  
    if ($stmt->execute()) {
        // User inserted successfully
        echo "<script>alert('User inserted successfully');</script>";
        // Redirect to avoid form resubmission
        header("Location: create-user.php ");
        exit();
    } else {
  
      echo "Error: " . $conn->error;
    }
  }

$conn->close();