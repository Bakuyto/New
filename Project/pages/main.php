<?php include '../connection/redirect.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main Page</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="contain-fluid">
<nav class="sticky-top top-0" style="background-color:white; z-index:999;">
      <ul>
        <li>
          <a class="active" href="#">Main</a>
        </li>
        <li>
          <a href="test.php">Test</a>
        </li>
        <li>
          <a href="create-user.php">Create</a>
        </li>
      </ul>
    </nav>
      <div class="main-header px-3 sticky-top bg-light" style='top:60px;'>
        <form class="d-flex" id="searchForm">
          <input class="form-control me-1" type="search"  id="searchInput" placeholder="Search by Name" aria-label="Search" style="width:260px">
        </form>
        
        

        <div class="form-inline d-flex flex-row gap-1">
          <button type="button" class="btn btn-primary" onclick="$('#addModal').modal('show')">Create</button>
          <input type="number" id="row" style="width:80px; height: 40px;" class="form-control"/>
          <button type="button" class="btn btn-success" id="filter">Filter</button>
        </div>
        
      </div>
      
      <section>
  <div class="tables container-fluid tbl-container d-flex flex-column justify-content-center align-content-center" style="height:75 vh;">
    <div class="row tbl-fixed">
      <table class="table-striped table-condensed" style="width:1920px !important;" id="myTable">
          <thead>
        <tr>
        <?php
            include '../connection/connect.php';

            $sql = "CALL update_table_column()";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<th class='text-center'>No<br><br><span style='color:#28ACE8;'></span></th>";
                    foreach ($row as $column_name => $value) {
                        if ($column_name == 'product_pk' || $column_name == 'product_status' || $column_name == 'product_fk') {
                            // Skip rendering product_status and product_fk
                            continue;
                        }
                        // Check if the current column is product_pk or product_name
                        if ($column_name == 'product_pk' || $column_name == 'product_name') {
                            // Remove the parentheses from the span
                            echo "<th id='" . $column_name . "' class='text-center'>" . $column_name . "<br><br><span id='" . $column_name . "' style='color:#28ACE8;'></span></th>";
                        } else {
                            echo "<th id='" . $column_name . "' class='text-center'>" . $column_name . "<br><span id='" . $column_name . "' class='text-danger'><span id='" . $column_name . "_sum'></span></span></th>";
                        }
                    }
                    break;
                }
            }
        ?>

        </tr>
      </thead>
      <tbody>
          <?php
            include '../connection/connect.php';

            $sql = "CALL update_table_column()";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $counter = 1; // Initialize a counter for generating new IDs
                while ($row = $result->fetch_assoc()) {
                    echo "<tr id='" . $row['product_pk'] . "'>"; // Generate new ID starting from 1
                    echo "<td>" . $counter . "</td>"; // Use the counter to generate each
                    $columnIndex = 1; // Initialize column index counter
                    foreach ($row as $column_name => $value) {
                        if ($column_name == 'product_pk' || $column_name == 'product_status' || $column_name == 'product_fk') {
                            continue;
                        }
                        echo "<td id='".$column_name."' class='editable";
                        if ($columnIndex == 3) {
                            echo " bg-custom"; // Add custom background class for the third column
                        }
                        echo "' data-column='" . $column_name . "' contenteditable='true' type='number'>" . $value . "</td>";
                        $columnIndex++; // Increment column index
                    }
                    echo "</tr>";
                    $counter++; // Increment the counter for the next row
                }
            }   
          ?>
          </tbody>
      </table>
    </div>
  </div>
</section>

      
    <div class="buttons d-flex align-content-end justify-content-end mt-3 px-2">
      <div class="page-of">Page <span id="current-page">1</span> of <span id="total-pages">1</span></div>
      <button id="prev-btn">Prev</button>
      <input type="number" placeholder="1" id="page-number" disabled>
      <button id="next-btn">Next</button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" style="--bs-modal-width: 1000px !important;" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h2 class="modal-title" id="addModalLabel">Create</h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="process_form.php">
                    <div class="row g-3" style="display: flex; flex-wrap: nowrap; overflow-x: auto;">
                        <?php
                            include '../connection/connect.php';

                            $sql = "SELECT
                            COLUMN_NAME AS department_name
                            FROM INFORMATION_SCHEMA.COLUMNS
                            WHERE TABLE_NAME = 'tblproduct_transaction'
                            AND ORDINAL_POSITION >= 2;";
                            $result = $conn->query($sql); // Execute the query

                            if ($result && $result->num_rows > 0) {
                                // Fetch column names from the database
                                $first = true; // Flag to track the first column
                                while ($row = $result->fetch_assoc()) {
                                    $department_name = $row["department_name"];
                                    ?>
                                    <div class="col-12 mb-3" style="flex: 0 0 auto; width: 200px;">
                                        <label class="form-label text-center fw-bolder w-100"><?= $department_name ?></label>
                                        <input type="text" class="form-control<?= $first ? ' required' : '' ?>" id="<?= $department_name ?>" name="<?= $department_name ?>"<?= $first ? ' required' : '' ?>>
                                    </div>
                                    <?php
                                    $first = false; // Unset flag after the first iteration
                                }
                            } else {
                                echo "<p>No results found</p>"; // Output if no results found
                            }
                        ?>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit_input" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/jquery.tabledit.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
<script>
    $(document).ready(function() {
        // Function to handle live editing of table cells
        $('.editable').on('blur', function() {
            var cellData = $(this).text(); // Get the new cell data
            var column = $(this).data('column'); // Get the column name
            var rowId = $(this).closest('tr').attr('id').replace('row_', ''); // Get the row ID

            // Send the updated data to the server using AJAX
            $.ajax({
                url: 'update.php', // Specify the URL of the server-side script to handle the update
                method: 'POST',
                data: {
                    column: column,
                    cellData: cellData,
                    rowId: rowId
                },
                success: function(response) {
                    // Handle the server response if needed
                    console.log(response);
                }
            });
        });
    });
</script>
<script>
    // Function to perform search
    function searchTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Assuming the second column (index 1) contains the name
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    // Event listener for search input
    document.getElementById("searchInput").addEventListener("keyup", function() {
        searchTable();
    });

    // Function to refresh table when search input is cleared
    function clearSearch() {
        var input = document.getElementById("searchInput");
        if (input.value === "") {
            // Clearing search input, so reset table to display all rows
            var table = document.getElementById("myTable");
            var tr = table.getElementsByTagName("tr");
            for (var i = 0; i < tr.length; i++) {
                tr[i].style.display = "";
            }
        }
    }

    // Event listener for clearing search input
    document.getElementById("searchInput").addEventListener("input", function() {
        clearSearch();
    });
</script>
<!-- Sum Column -->
<script>
    $(document).ready(function() {
    // Function to calculate and update sums
    function updateSums() {
        // AJAX request to fetch sum data from server
        $.ajax({
            url: 'fetch_sums.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Update sums in the table
                $.each(data, function(columnName, total) {
                    $('#' + columnName + '_sum').text('(' + total + ')');
                });
                
                // Call updateSums again after current update completes
                updateSums();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching sums:', error);
                
                // Call updateSums again in case of error
                updateSums();
            }
        });
    }

    // Initial calculation and update on page load
    updateSums();
});
</script>
</html>