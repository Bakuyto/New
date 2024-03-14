<?php
// Check if form is submitted
if(isset($_POST['submit_user'])) {
    // Database connection
    include '../connection/connect.php';

    // Retrieve form data
    $user_full_name = $conn->real_escape_string($_POST['user_full_name']);
    $user_log_name =  $conn->real_escape_string($_POST['user_log_name']);
    $user_log_password = $conn->real_escape_string($_POST['user_log_password']);
    $user_level_fk = intval($_POST['user_level_fk']); // Convert to integer
    $user_department_fk = intval($_POST['user_department_fk']);

    // Check if user ID is set (for update operation)
    if(isset($_POST['edit_user'])) {
        $user_id = $_POST['user_id'];

        // Update query
        $sql = "UPDATE tbluser 
                SET user_full_name = '$user_full_name', 
                    user_log_name = '$user_log_name', 
                    user_log_password = '$user_log_password', 
                    user_level_fk = '$user_level_fk', 
                    user_department_fk = '$user_department_fk' 
                WHERE user_pk = '$user_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            header("Location: create-user.php");
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Insert query
        $sql = "CALL Insert_User('$user_full_name', '$user_log_name', '$user_log_password', '$user_level_fk', '$user_department_fk')";


        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header("Location: create-user.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close database connection
    $conn->close();
}