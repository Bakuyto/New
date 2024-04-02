<?php
include '../connection/connect.php';

$sql = "CALL update_table_column()";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $sums = array();
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $column_name => $value) {
            if ($column_name == 'product_status' || $column_name == 'product_fk') {
                // Skip product_status and product_fk
                continue;
            }
            // Check if the current column is product_pk or product_name
            if ($column_name != 'product_pk' && $column_name != 'product_name') {
                // Calculate sum for the current column
                if (!isset($sums[$column_name])) {
                    $sums[$column_name] = 0;
                }
                $sums[$column_name] += $value;
            }
        }
    }
    // Return sums as JSON
    echo json_encode($sums);
}
?>
