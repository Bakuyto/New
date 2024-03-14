$(document).ready(() => {
    // Define the filtering logic
    $('#filter').on('click', () => {
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

    $("#page-number").on("change", () => {
        const pageNum = parseInt($(this).val());
        if (!isNaN(pageNum)) {
            goToPage(pageNum);
        }
    });

    // Initial setup
    showPage(currentPage);
    $("#total-pages").text(totalPages);
});

