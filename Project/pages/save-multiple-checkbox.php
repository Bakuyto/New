<?php
include '../connection/connect.php';

  // Handling form submission for creating a new department's transaction
  if(isset($_POST['save_multiple_checkbox'])) {
    $department_pk = $_POST['department_pk']; // Get the department_pk from the form
    $brands = $_POST['brands']; // Get the selected brands array from the form
  
    // Check if any brand is selected
    if(!empty($brands)) {
        // Prepare the stored procedure call
        $stmt = $conn->prepare("CALL Insert_Multiple_Checkbox(?, ?)");
  
        // Bind parameters
        $stmt->bind_param("is", $department_pk, $brand);
  
        // Execute the stored procedure for each selected brand
        foreach($brands as $brand) {
            $stmt->execute();
        }
  
        // Close the statement
        $stmt->close();
  
        // Redirect or output success message
        echo "Data inserted successfully!";
        header("Location: create-user.php ");
        // You can redirect the user to another page or show a success message here
    } else {
        // No brands selected, handle this case
        echo "Please select at least one brand!";
        // You can redirect the user back to the form or show an error message
    }
    }
  

$conn->close();