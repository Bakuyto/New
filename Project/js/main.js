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
    const rowsPerPage = 12;
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


// Function to handle click event of table cell for editing
$("td.editable").on("click", function() {
    // Check if the cell is not in the first column (assuming ID column is the first column)
    if (!$(this).prev().length) {
        return; // Exit the function if the cell is in the first column
    }
    
    var oldValue = $(this).text();
    var productId = $(this).closest("tr").attr("id");
    var column = $(this).attr("data-column");
    var newValue = prompt("Enter new value:", oldValue);

    if (newValue != null && newValue !== oldValue) {
        var self = $(this);
        $.ajax({
            url: "update.php",
            type: "POST",
            data: { id: productId, column: column, newValue: newValue },
            dataType: "json", // Specify the expected data type
            success: function(response) {
                console.log("AJAX Success:", response);
                if (response.success) {
                    self.text(newValue);
                    // alert(response.message);
                    console.log("Reloading page...");
                    window.location.reload(); // Reload the page after a successful update
                } else {
                    console.error("Update failed:", response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }
});




});
