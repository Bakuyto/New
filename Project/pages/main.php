<?php include '../connection/redirect.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main Page</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/style.css">
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
          <input class="form-control me-1 w-100" type="search" id="searchInput" placeholder="Search by Name" aria-label="Search">
        </form>
        
        

        <div class="form-inline d-flex flex-row gap-1">
          <button type="button" class="btn btn-primary" onclick="$('#addModal').modal('show')">Create</button>
          <input type="number" id="row" style="width:60px; height: 40px;" class="form-control"/>
          <button type="button" class="btn btn-success" id="filter">Filter</button>
        </div>
        
      </div>
      
      <section>
  <div class="tables container-fluid tbl-container d-flex flex-column justify-content-center align-content-center">
    <div class="row tbl-fixed">
      <table class="table-striped table-condensed" style="width:1920px !important;" id="myTable">
      <thead>
  <tr>
    <?php
      include '../connection/connect.php';

      $sql = "SELECT tblproduct_transaction.*, tblproduct_sales_months.*
              FROM tblproduct_transaction
              INNER JOIN tblproduct_sales_months
              ON tblproduct_transaction.product_pk = tblproduct_sales_months.product_fk;";

      $result = $conn->query($sql); // Execute the query

      if ($result && $result->num_rows > 0) {
          // Output column names from the database
          echo "<tr>"; // Start table row
          $transactionColumnCount = $result->field_count - 1; // Exclude product_fk
          $extraColumnAdded = false;
          while ($row = $result->fetch_assoc()) {
              foreach ($row as $column_name => $value) {
                  if ($column_name == 'product_status') {
                      // Skip rendering product_status
                      continue;
                  }
                  if ($column_name == 'product_fk') {
                      // Adding extra column before product_fk
                      if (!$extraColumnAdded) {
                          echo "<th class='text-center'>Current Stock</th>";
                          echo "<th class='text-center'>Total</th>";
                          $extraColumnAdded = true;
                      }
                      continue;
                  }
                  echo "<th class='text-center' id='rowtotal'>" . $column_name . "</th>";
              }
              break; // Break after outputting column names of the first row
          }
          echo "</tr>"; // End table row
      } else {
          echo "<th>No results found</th>"; // Output if no results found
      }
    ?>
  </tr>
</thead>

<tbody>
<?php
  include '../connection/connect.php';

  $sql = "SELECT * FROM tblproduct_transaction INNER JOIN tblproduct_sales_months ON tblproduct_transaction.product_pk = tblproduct_sales_months.product_fk";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // Fetch column names dynamically
      $columns = array();
      $row = $result->fetch_assoc();
      foreach ($row as $key => $value) {
          if ($key != 'product_fk') {
              $columns[] = $key;
          }
      }
      // Reset the result pointer back to the beginning
      $result->data_seek(0);
      // Output data row by row
      while ($row = $result->fetch_assoc()) {
          echo "<tr id=\"" . $row['product_pk'] . "\">";
          // Initialize total variable
          $total = 0;
          foreach ($columns as $column) {
              if ($column == 'product_status') {
                  // Skip rendering product_status and product_pk
                  continue;
              }
              
              // Calculate total for January column
              if ($column == 'January') {
                echo "<td name='current_stock' class='text-center'></td>"; // Placeholder for current stock with initial value 0
                echo "<td name='total' class='text-center' ></td>"; // Display total if it's not 0
              }
              echo "<td class='editable' data-column='" . $column . "'>" . $row[$column] . "</td>";
          }
          echo "</tr>";
      }
  } else {
      echo "<tr><td colspan='" . (count($columns) + 1) . "'>0 results</td></tr>"; // Output if no results found
  }

  $conn->close(); // Close the database connection
?>

  </tbody>
      </table>
    </div>
  </div>
</section>


      
    <div class="buttons d-flex align-content-end justify-content-end mt-3 px-2">
      <div class="page-of">Page <span id="current-page">1</span> of <span id="total-pages">1</span></div>
      <button id="prev-btn">Prev</button>
      <input type="number" placeholder="1" id="page-number" min="1" max="1">
      <button id="next-btn">Next</button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" style="--bs-modal-width: 1000px !important;" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header px-5">
                <h2 class="modal-title" id="addModalLabel">Create</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="process_form.php"> <!-- Specify the PHP script to handle form submission -->
                    <div class="tables container-fluid tbl-container d-flex flex-column justify-content-center align-content-center">
                        <div class="row tbl-fixed">
                            <table class="table-striped table-condensed" id="myTable">
                                <thead>
                                    <tr>
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
                                          $columns = array();
                                          while ($row = $result->fetch_assoc()) {
                                              $columns[] = $row["department_name"];
                                              echo "<th class='text-center'>" . $row["department_name"] . "</th>";
                                          }
                                      } else {
                                          echo "<th>No results found</th>"; // Output if no results found
                                      }
                                    ?>
                                   </tr>
                                </thead>
                                <?php
                                  // Output empty input fields in the tbody
                                  echo "<tbody><tr>";
                                  if ($result && $result->num_rows > 0) {
                                      foreach ($columns as $index => $column) {
                                          // Check if it's the first column
                                          if ($index === 0) {
                                              echo "<td><input type='text' name='" . $column . "' required></td>";
                                          } else {
                                              echo "<td><input type='text' name='" . $column . "'></td>";
                                          }
                                      }

                                      
                                  } else {
                                      // Output a single cell spanning all columns if no results found
                                      echo "<td colspan='" . count($columns) . "'>No data available</td>";
                                  }
                                  echo "</tr></tbody>";
                                ?> 

                            </table>
                        </div>
                    </div>
                    <div class='form-group mb-3 mt-3 d-flex justify-content-end'>
                        <button type='button' class='btn btn-secondary mx-2' data-bs-dismiss='modal'>Close</button>
                        <button type='submit' name='submit_input' class='btn btn-primary'>Submit</button>
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
// Function to calculate and update the current stock
function updatecurrent_stock() {
  $('#myTable tbody tr').each(function() {
    var current_stock = 0;
    var currentIndex = $(this).find('td.editable').index($(this).find('td.editable:focus')); // Get the index of the currently focused editable cell
    var threshold = $(this).find('td.editable').length; // Get the number of editable cells in the row
    
    // Determine the number of columns before the "current_stock" column dynamically
    var columnCount = $(this).find('td[name="current_stock"]').index();
    
    // Loop through each editable cell before the current one
    $(this).find('td.editable').each(function(index) {
      if (index !== 0 && index !== 1 && index < columnCount) { // Skip product_fk (index 0) and only consider columns before the "current_stock" column
        var value = parseInt($(this).text()) || 0;
        current_stock += value;
      }
    });
    // Update the corresponding "current_stock" cell in the row
    $(this).find('td[name="current_stock"]').text(current_stock);
  });
}

// Event listener for input changes in the editable cells
$('#myTable tbody td.editable').on('input', function() {
  updatecurrent_stock(); // Recalculate the current stock when a value changes
});

// Call updatecurrent_stock() on document ready to ensure it runs when the page loads
$(document).ready(function() {
  updatecurrent_stock();
});


  // Function to calculate and update the total
  function updateTotal() {
    var totalColumnIndex = $('th:contains("Total")').index() + 1; // Get the index of the "Total" column
    $('#myTable tbody tr').each(function() {
      var total = 0;
      $(this).find('td.editable').each(function(index) {
        // Skip the first two non-editable columns (current_stock and total)
        if (index > 1) {
          var value = parseInt($(this).text()) || 0; // Get the cell value, default to 0 if not a number
          total += value;
        }
      });
      $(this).find('td[name="total"]').text(total); // Update the total cell with the calculated total
    });
  }

// Event listener for input changes in the editable cells
$('#myTable tbody td.editable').on('input', function() {
  updateTotal(); // Recalculate the total when a value changes
});

// Function to handle subtraction or addition
function handleOperation(cell) {
  var value = -parseInt(cell.text()) || 0; // Get the entered value
  var totalCell = cell.closest('tr').find('td[name="total"]');
  var total = parseInt(totalCell.text()) || 0; // Get the current total
  var newValue = total; // Convert the absolute value to negative
  totalCell.text(total - value); // Add the negative value to the total
}

  // Initial calculation of the total
  $(document).ready(function() {
    updateTotal();
  });
</script>
<script>
  $(document).ready(function() {
// Define the filtering logic
$('#filter').on('click', function() {
    const rowLimit = $('#row').val();
    // Check if rowLimit is empty, refresh the page if it is
    if (!rowLimit) {
        location.reload();
        return;
    }
    filterTable('myTable', rowLimit);
});

const filterTable = (tableId, rowLimit) => {
    const $table = $('#' + tableId);
    const $rows = $table.find('tbody tr');

    // Hide all tbody rows initially
    $rows.hide();

    // Show only the specified number of tbody rows starting from index 0
    if (rowLimit === '' || parseInt(rowLimit) === 0) {
        // If rowLimit is empty or equal to 0, reload the page
        location.reload();
    } else {
        $rows.slice(0, parseInt(rowLimit)).show();
    }
};

    // Define the pagination logic
    const rowsPerPage = 10;
    const $table = $("#myTable");
    const $tbodyRows = $table.find("tbody tr");
    let totalPages = Math.ceil($tbodyRows.length / rowsPerPage);
    let currentPage = 1;

    const showPage = (page) => {
        // Hide all tbody rows
        $tbodyRows.hide();

        // Calculate start and end indices for the current page
        const startIndex = (page - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;

        // Show only the tbody rows for the current page
        $tbodyRows.slice(startIndex, endIndex).show();

        // Update displayed page number
        $("#current-page").text(page);
    };

    const goToPage = (page) => {
        if (page >= 1 && page <= totalPages) {
            currentPage = page;
            showPage(currentPage);
            $("#page-number").val(currentPage);
        }
    };

    // Event listeners for pagination controls
    $("#prev-btn").on("click", () => {
        goToPage(currentPage - 1);
    });

    $("#next-btn").on("click", () => {
        goToPage(currentPage + 1);
    });

    $("#page-number").on("change", function() {
        const pageNum = parseInt($(this).val());
        if (!isNaN(pageNum)) {
            goToPage(pageNum);
        }
    });

    // Initial setup
    showPage(currentPage);
    $("#total-pages").text(totalPages);

    // Store the original table rows
    var originalTableRows = $('#table-body').html();

    // Function to handle search
    function handleSearch() {
        var searchText = $('#searchInput').val().toLowerCase();
        var rowsToShow = 0;

        // Loop through each table row
        $('#myTable tbody tr').each(function() {
            var rowText = $(this).text().toLowerCase();

            // Check if the row contains the search text
            if (searchText === '' || rowText.indexOf(searchText) !== -1) {
                $(this).show(); // Show row if it matches search text or if search text is empty
                rowsToShow++;
            } else {
                $(this).hide(); // Hide row if it doesn't match search text
            }
        });

        // Show no results message if necessary
        if (rowsToShow === 0 && searchText !== '') {
            var noResultsMessage = '<tr><td colspan="' + $('#myTable th').length + '">No results found</td></tr>';
            $('#table-body').html(noResultsMessage);
        }
        
        // Reload the page when search input is cleared
        if (searchText === '') {
            location.reload();
        }
    }

    // Bind the keyup event of the search input
    $('#searchInput').keyup(handleSearch);

    $("td.editable").on("click", function() {
        // Check if the cell is not in the first column (assuming ID column is the first column)
        if (!$(this).prev().length) {
            return; // Exit the function if the cell is in the first column
        }
    
        var oldValue = $(this).text().trim();
    
        // Set the contenteditable attribute to true to make the cell editable
        $(this).attr("contenteditable", "true").focus();
    
        // On blur event, send AJAX request to update the value
        $(this).on("blur", function() {
            var newValue = $(this).text().trim();
            if (newValue !== oldValue) {
                var productId = $(this).closest("tr").attr("id");
                var column = $(this).attr("data-column");
    
                // Send AJAX request to update the value
                $.ajax({
                    url: "update.php",
                    type: "POST",
                    data: { id: productId, column: column, newValue: newValue },
                    dataType: "json",
                    success: function(response) {
                        console.log("AJAX Success:", response);
                        if (response.success) {
                            $(this).text(newValue); // Update the cell text with the new value
                        } else {
                            console.error("Update failed:", response.message);
                            $(this).text(oldValue); // Revert the cell text to the original value
                        }
                    }.bind(this), // Ensure correct context inside the success callback
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                        $(this).text(oldValue); // Revert the cell text to the original value
                    }.bind(this) // Ensure correct context inside the error callback
                });
            } else {
                // If the value hasn't changed, simply display the text
                $(this).text(oldValue);
            }
    
            // Remove the blur event handler after editing
            $(this).removeAttr("contenteditable").off("blur");
        });
    });
    
});
</script>

</html>