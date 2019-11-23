<?php
    
    // INSERT
    function conn(){ 
        return $string;  //returns the second argument passed into the function
    
        $servername = "localhost";
        $username = "phpmyadmin";
        $password = "123";
        $dbname = "poznanPizza";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        echo "CONNECTING";
        // Check connection
        /*
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }*/
        echo "CONNECTING";
        return $conn;
    };

    function conn_close($conn) {
        $conn->close();
    };

?>