<?php
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

$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
$id = 0;

echo "<a href='http://localhost/phpAssignment/order.html'> Create orders </a>";

echo "<br>";
echo "<br>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo " - Name: " . $row["firstname"] . "<br>";
        echo " - Phone " . $row["phone"] . "<br>";
        echo " - Street " . $row["street"] . "<br>";
        echo " - Price " . $row["price"] . "<br>";
        echo ' <form  id="open-orders" name="open_orders" method="post" action="close_order.php">
            <input id="order'.$id.'" type="text" name="order_id" value="'.$row["id"].'" hidden/>
            <input type="submit" name="button" id="test" value="Close"/><br/>
        </form>';
        $id ++;
    }
} else {
    echo "There is no open orders";
}
$conn->close();
?>