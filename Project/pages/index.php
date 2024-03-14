<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table Form</title>
</head>
<body>
    <form action="process.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Parse the HTML to count the number of columns dynamically
                $dom = new DOMDocument();

                $numColumns = 0;
                $headerRow = $dom->getElementsByTagName('thead')->item(0)->getElementsByTagName('tr')->item(0);
                $headerCells = $headerRow->getElementsByTagName('th');
                $numColumns = $headerCells->length;

                for ($i = 0; $i < $numColumns; $i++) {
                    echo "<tr>";
                    echo "<td><input type='text' name='name[]' /></td>";
                    echo "<td><input type='email' name='email[]' /</td>";
                    echo "</tr>";
                }

                // Loop through each row in the <tbody> section
                $tbody = $dom->getElementsByTagName('tbody')->item(0);
                $rows = $tbody->getElementsByTagName('tr');
                foreach ($rows as $row) {
                    // Loop through each cell in the row
                    $cells = $row->getElementsByTagName('td');
                    for ($i = 0; $i < $numColumns; $i++) {
                        $cell = $cells->item($i);
                        // Check if the cell is empty
                        if ($cell->textContent === "") {
                            // Get the corresponding column header from the <thead> section
                            $headerCell = $headerRow->getElementsByTagName('th')->item($i);
                            $columnHeader = $headerCell->textContent;
                            
                            // Add a placeholder value or perform any other action you need
                            $cell->textContent = "Empty: " . $columnHeader;
                        }
                    }
                }
                ?>
            </tbody>
        </table>
        <button type="submit">Submit</button>
    </form>
</body>
</html>