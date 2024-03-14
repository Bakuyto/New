<?php
include '../connection/connect.php';

// Handling form submission for creating a new transaction
if(isset($_POST['submit_transaction']) && isset($_POST['column_name']) && !empty($_POST['column_name'])) {
    $column_name = $conn->real_escape_string($_POST['column_name']);
    $sql = "CALL Insert_Column('$column_name')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data inserted successfully');</script>";
        // Redirect to avoid form resubmission
        header("Location: create-user.php ");
        exit();
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
        header("Location: create-user.php ");
    }
}

$conn->close();
