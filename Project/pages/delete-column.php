<?php
include '../connection/connect.php';

// Handling column deletion
if(isset($_POST['submit_delete_transaction']) && isset($_POST['transactionToDelete']) && !empty($_POST['transactionToDelete'])) {
    $transaction_value = $conn->real_escape_string($_POST['transactionToDelete']);
    $sql = "CALL Delete_Column('tblproduct_transaction','$transaction_value')";
  
    if ($conn->query($sql) === TRUE) {
      // Close the database connection
      $conn->close();

      // Redirect to avoid form resubmission or reload the current page
      header("Location: create-user.php");
      exit(); // Ensure script execution stops after redirection
    } else {
      header("Location: create-user.php");
    }
} else {
    echo "Transaction name not received or is empty.";
}
