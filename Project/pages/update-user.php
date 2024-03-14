<?php
include '../connection/connect.php'; // Include database connection

// Check if data is received
if (isset($_POST['update-user'])) {
    $user_pk = $_POST['user_pk']; // Receive user_pk from the form
    $user_full_name = $_POST['user_full_name'];
    $user_log_name = $_POST['user_log_name'];
    $user_log_password = $_POST['user_log_password'];
    $user_level_fk = $_POST['user_level_fk'];
    $user_department_fk = $_POST['user_department_fk'];

    // Prepare the SQL statement with placeholders
    $stmt = $conn->prepare("UPDATE tbluser SET user_full_name=?, user_log_name=?, user_log_password=?, user_level_fk=?, user_department_fk=? WHERE user_pk=?");

    // Bind parameters to the prepared statement
    $stmt->bind_param("ssssii", $user_full_name, $user_log_name, $user_log_password, $user_level_fk, $user_department_fk, $user_pk);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record updated successfully";
        // Redirect to a new page after successful update if needed
        header("Location: create-user.php");
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo "Update user data not received.";
}

