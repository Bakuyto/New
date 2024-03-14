<?php 
session_start();
include '../connection/connect.php'; 

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if your_condition is set and not empty
    if (isset($_POST['delete']) && !empty($_POST['delete'])) {
        // Sanitize the input to prevent SQL injection
        $delete = mysqli_real_escape_string($conn, $_POST['delete']);

        // SQL to delete a record
        $sql = "CALL Delete_Column('tblproduct_transaction','$delete')";

        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Your condition is not set or empty.";
    }
    // Close the database connection
    $conn->close();
} else {
    // If the request method is not POST, redirect back to the page where the delete button is located
    header("Location: create-user.php");
    exit();
}
?>
