$(document).ready(function() {
    // Define the filtering logic
    $('#filter').on('click', function() {
        const rowLimit = $('#row').val();
        filterTable('myTable', rowLimit);
    });

    const filterTable = (tableId, rowLimit) => {
        const $table = $('#' + tableId);
        const $rows = $table.find('tbody tr');

        // Hide all tbody rows initially
        $rows.hide();

        // Show only the specified number of tbody rows starting from index 0
        $rows.slice(0, parseInt(rowLimit)).show();
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
});
