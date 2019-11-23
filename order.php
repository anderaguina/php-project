<?php
    // Calculate price
    // include 'connect.php';



    $small = 5;
    $medium = 9;
    $large = 12;
    $topping = 1;

    // Check size of pizza
    if ($_POST['pizzaSize'] == 'large') {
        $size = $large;
    } elseif ($_POST['pizzaSize'] == 'medium') {
        $size = $medium;
    } else if ($_POST['pizzaSize'] == 'small') {
        $size = $small;
    }

    $topping_number = 0;
    $toppings = False;

    // Check how many toppings were added
    if ($_POST['addAnchovies'] == "yes") {
        $topping_number++;
        $toppings = True;
    }

    if ($_POST['addPineapple'] == "yes") {
        $topping_number++;
        $toppings = True;
    }

    if ($_POST['addKielbasa'] == "yes") {
        $topping_number++;
        $toppings = True;
    }

    if ($_POST['addOlives'] == "yes") {
        $topping_number++;
        $toppings = True;
    }


    if ($_POST['addOnion'] == "yes") {
        $topping_number++;
        $toppings = True;
    }

    if ($_POST['addPeppers'] == "yes") {
        $topping_number++;
        $toppings = True;
    }
    
    // If there is at least 1 topping decrease by 1 the number of toppings since 1 is free
    if ($toppings == True) {
        $topping_number--;
    }


    // Calculate price based on the size of the pizza and the number of toppings
    if ($_POST['pizzaSize'] == "small") {
        $toppings_price = $topping_number / 2;
    } else {
        $toppings_price = $topping_number;
    }

    $final_price = $size + $toppings_price;

    // Pessel number
    $pessel = $_POST['pessel'];
    // Verify pesel number and apply discount
    $final_price = valid_pesel($pessel, $final_price);

    // INSERT order information in db

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

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO orders (firstname, phone, street, price)
    VALUES ('".$name."', '".$phone."', '".$address."', ".$final_price.")";

    // If the insert was successful print details from the order + buttons to navigate to other pages
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
        echo "Your order is " . $final_price. "<br>";
        echo "<a href='http://localhost/phpAssignment/order.html'> Create new order </a> <br>";
        echo "<a href='http://localhost/phpAssignment/open.php'> View open orders </a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    

    function valid_pesel(String $pesel, int $price) {
        // If pesel field is empty it's not valid
        if (empty($pesel)) {
            return $price;
        }
        // Split the string into an array of characters
        $pesel_chars = str_split($pesel);

        // Get the last character of the pesel number
        $last_digit = $pesel_chars[sizeof($pesel_chars) - 1];
        

        // -1 For staying inside the boundary of the variable and another - 1 to ignore the last digit
        for ($x = 0; $x <= sizeof($pesel_chars ) - 2; $x++) {
            $mult = 0;
            if (($x +1) % 4 == 1) {
                $mult = 1;
            } else if(($x +1) % 4 == 2) {
                $mult = 3;
            } else if(($x +1) % 4 == 3) {
                $mult = 7;
            } else if(($x +1) % 4 == 0) {
                $mult = 9;
            };
            // Execute the operation
            $sum = $sum + $pesel_chars[$x] * $mult;
        };

        $modulo = $sum % 10;

        $checksum = 0;
        if ($last_digit != 0) {
            $checksum = 10 - $modulo;
        };

        if ($last_digit == $checksum) {
            return $price - ($price / 10);
        } else {
            return $price;
        }
    }
    
?>