    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inventorymanagement";

    //create connection

    $conn = new mysqli($servername, $username, $password, $dbname);

    //check connection 

    if($conn->connect_error){
        echo "connection successfully";
    }

    ?>