 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tfg17sql";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

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