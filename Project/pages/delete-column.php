<?php
include '../connection/connect.php';

// Handling column deletion
if(isset($_POST['submit_delete_transaction']) && isset($_POST['transactionToDelete']) && !empty($_POST['transactionToDelete'])) {
    $transaction_value = $conn->real_escape_string($_POST['transactionToDelete']);
    $sql = "CALL Delete_Column('tblproduct_transaction','$transaction_value')";
  
    if ($conn->query($sql) === TRUE) {
        // Close the prepared statement to avoid potential memory leaks
        $conn->close();

        // Redirect to avoid form resubmission or reload the current page
        
        exit();
    } else {
      header("Location: create-user.php");
    }
}

