<?php

header("Content-Type: application/json; charset=UTF-8");
$servername = "localhost";
$username = "userSST";
$password = "fastparking";
$dbname = "parking";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

 //Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

$poly_coor =  mysqli_query( $conn , "SELECT longitude,latitude FROM starting_point");
	
$row = mysqli_fetch_assoc($poly_coor);

$myJSON = json_encode($row);

echo "myFunc(".$myJSON.")";

$conn->close();


?>