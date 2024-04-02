<?php
// Include your database connection file
include '../connection/connect.php';

// Default SQL query to fetch all data
$sql = "CALL update_table_column()"; // Modify this query according to your database schema

// Check if a search term is provided in the request
if(isset($_GET['search']) && !empty($_GET['search'])) {
    // Sanitize the search term to prevent SQL injection
    $search = $conn->real_escape_string($_GET['search']);
    // Modify the SQL query to include a WHERE clause for searching
    $sql .= " WHERE product_name LIKE '%$search%'"; // Modify 'column_name' according to your database column to search
}

// Perform the SQL query
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
?>
