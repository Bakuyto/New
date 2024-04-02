<?php

// Include your database connection file
include '../connection/connect.php';

// Check if the POST data is set
if(isset($_POST['column'], $_POST['cellData'], $_POST['rowId'])) {
    // Sanitize the data to prevent SQL injection
    $column = $conn->real_escape_string($_POST['column']);
    $cellData = $conn->real_escape_string($_POST['cellData']);
    $rowId = $conn->real_escape_string($_POST['rowId']);

    // Build and execute the SQL query to update the specific cell in the database
    $sql = "UPDATE tblproduct_transaction JOIN tblproduct_sales_months ON tblproduct_transaction.product_pk = tblproduct_sales_months.product_fk SET $column = ? WHERE product_pk = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error: " . $conn->error;
        exit(); // Exit if there's an error in preparing the statement
    }

    // Bind parameters and execute
    $stmt->bind_param("si", $cellData, $rowId);
    if ($stmt->execute()) {
        // If the update was successful, fetch the updated row
        $sql_fetch = "SELECT * FROM tblproduct_transaction JOIN tblproduct_sales_months ON tblproduct_transaction.product_pk = tblproduct_sales_months.product_fk WHERE product_pk = $rowId";
        $result_fetch = $conn->query($sql_fetch);
        if ($result_fetch && $result_fetch->num_rows > 0) {
            $row = $result_fetch->fetch_assoc();
            echo json_encode($row); // Return the updated row data as JSON
        } else {
            echo "Error: Failed to fetch updated row";
        }
    } else {
        // If there was an error with the update, return an error message
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // If the POST data is not set, return an error message
    echo "Error: Missing POST data";
}

// Close the database connection
$conn->close();
?>
