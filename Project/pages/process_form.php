<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_input"])) {
    // Include your database connection script
    include '../connection/connect.php';

    // Assuming your form fields are named after database columns
    // You can retrieve the values submitted in the form like this:
    $values = array();
    foreach ($_POST as $key => $value) {
        // Prevent SQL injection by using prepared statements
        $escaped_value = $conn->real_escape_string($value);
        
        // Set default value to '0' if the field is empty
        $values[$key] = !empty($escaped_value) ? $escaped_value : '0';
    }

    // Remove 'submit_input' from the array of values
    unset($values['submit_input']);

    // Now, you can process the submitted data, for example, inserting it into the database
    // Assuming 'tblproduct_transaction' is your table name
    $columns = implode(", ", array_keys($values));
    $columnValues = "'" . implode("', '", $values) . "'";

    $sql = "INSERT INTO tblproduct_transaction ($columns) VALUES ($columnValues)";
    if ($conn->query($sql) === TRUE) {
        // Insertion successful for tblproduct_transaction
        echo "New record created successfully for tblproduct_transaction";
        
        // Get the ID generated for the inserted record
        $last_insert_id = $conn->insert_id;

        // Now insert into tblproduct_sales_months with the obtained ID
        $product_fk = $last_insert_id; // Use the ID from tblproduct_transaction
        $sql_sales_months = "INSERT INTO tblproduct_sales_months (product_fk) VALUES ('$product_fk')";
        
        if ($conn->query($sql_sales_months) === TRUE) {
            // Insertion successful for tblproduct_sales_months
            echo "New record created successfully for tblproduct_sales_months";
            header("location: main.php");
            exit(); // Exit after redirection to prevent further execution of PHP code
        } else {
            // Error occurred for tblproduct_sales_months
            echo "Error: " . $sql_sales_months . "<br>" . $conn->error;
        }
    } else {
        // Error occurred for tblproduct_transaction
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
