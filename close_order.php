<?php
    // Calculate price


    // DELETE

    $servername = "localhost";
    $username = "phpmyadmin";
    $password = "123";
    $dbname = "poznanPizza";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "DELETE FROM orders WHERE id=". $_POST["order_id"];
    // VALUES ('Ander', '123', 'street', 25.5)";

    // echo "DELETING : " . $_POST["order_id"];
    
    
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header("Location: http://localhost/phpAssignment/open.php"); 
    exit();
    $conn->close();

?>