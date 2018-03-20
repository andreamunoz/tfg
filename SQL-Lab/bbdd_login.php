 <?php
include ("\bbdd_config_real.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT user FROM usuario;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "user: " . $row["user"]."<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?> 