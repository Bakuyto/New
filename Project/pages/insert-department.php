<?php
include '../connection/connect.php';

  // Handling form submission for creating a new department
  if(isset($_POST['submit_department']) && isset($_POST['department_name']) && !empty($_POST['department_name'])) {
    $department_name = $conn->real_escape_string($_POST['department_name']);
    $sql = "CALL Insert_department('$department_name')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data inserted successfully');</script>";
        // Redirect to avoid form resubmission
        header("Location: create-user.php");
        exit();
    } else {
      echo "<script>alert('Department name cannot be empty');</script>";
    }
}

$conn->close();
