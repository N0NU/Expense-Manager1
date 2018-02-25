<html>
<body>

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Create connection
$conn = new mysqli('localhost', 'root', '1234', 'exp_mngr');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT Date, Entertainment, Food, Vehicle, Grocery FROM expense";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> Date: ". $row["Date"]. "   Entertainment: ". $row["Entertainment"]. "   Food: ". $row["Food"] . "   Vehicle: ". $row["Vehicle"] ."   Grocery: ". $row["Grocery"] ."<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?> 

</body>
</html>