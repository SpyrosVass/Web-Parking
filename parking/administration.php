<?php


$username1 = $_POST["x"];
$password1 = $_POST["y"];

$servername = "localhost";
$username = "userSST";
$password = "fastparking";
$dbname = "parking";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";




$sql = "SELECT username,password FROM admins";

$sql = mysqli_query( $conn , $sql);
$sql = mysqli_fetch_assoc($sql);

$help1 = $sql['username'];
$help2 = $sql['password'];

if($username1 != $help1 || $password1 != $help2){
	die ("Λάθος username ή κωδικός");
}else {
    echo "1";	
}



$conn->close();


?>