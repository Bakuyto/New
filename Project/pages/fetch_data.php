<?php
// Include your database connection file
include '../connection/connect.php';

// Perform your SQL query to fetch updated data
$sql = "CALL update_table_column()"; // Modify this query according to your database schema
$result = $conn->query($sql);

// Prepare an array to hold the fetched data
$data = array();

if ($result && $result->num_rows > 0) {
    // Fetch each row from the result set
    while ($row = $result->fetch_assoc()) {
        // Add modified row to the data array
        $data[] = $row;
    }
}
// Close the database connection
$conn->close();

// Output data as JSON
echo json_encode($data);