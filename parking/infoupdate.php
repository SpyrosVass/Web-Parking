<?php

$value =$_GET["y"];
$switch =$_GET["z"];
$id = $_GET["x"];

$switch = (int)$switch;

if($switch==25 ){
	$value = (float)$value;
}else{
	$value = (float)$value;
}

$id = (int)$id;


if (is_int($switch) == FALSE || $switch>=26 || $switch<=0){
	die ("Διαλέξτε επίπεδο");
}
if (is_int($id) == FALSE || $id<=0){
	die ("Λάθος!");
}
if ((is_float($value) == FALSE || $value>1 || $value<0) && $switch!=25){
	die ("Λάθος. Εισάγετε τιμές στο [0,1]");
}
if (((is_numeric( $value ) && floor( $value ) != $value)  || $value<0) && $switch==25){
	die ("Λάθος. Εισάγετε ακέραιο, θετικό αριθμό");
}



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

switch ($switch) {
    case 1:
        $sql = "UPDATE info SET hour0 = $value WHERE id=$id";
        break;
    case 2:
        $sql = "UPDATE info SET hour1 = $value WHERE id=$id";
        break;
    case 3:
        $sql = "UPDATE info SET hour2 = $value WHERE id=$id";
        break;
	case 4:
        $sql = "UPDATE info SET hour3 = $value WHERE id=$id";
        break;
    case 5:
        $sql = "UPDATE info SET hour4 = $value WHERE id=$id";
        break;
    case 6:
        $sql = "UPDATE info SET hour5 = $value WHERE id=$id";
        break;
	case 7:
        $sql = "UPDATE info SET hour6 = $value WHERE id=$id";
        break;
    case 8:
        $sql = "UPDATE info SET hour7 = $value WHERE id=$id";
        break;
    case 9:
        $sql = "UPDATE info SET hour8 = $value WHERE id=$id";
        break;
	case 10:
        $sql = "UPDATE info SET hour9 = $value WHERE id=$id";
        break;
    case 11:
        $sql = "UPDATE info SET hour10 = $value WHERE id=$id";
        break;
    case 12:
        $sql = "UPDATE info SET hour11 = $value WHERE id=$id";
        break;
	case 13:
        $sql = "UPDATE info SET hour12 = $value WHERE id=$id";
        break;
    case 14:
        $sql = "UPDATE info SET hour13 = $value WHERE id=$id";
        break;
    case 15:
        $sql = "UPDATE info SET hour14 = $value WHERE id=$id";
        break;
	case 16:
        $sql = "UPDATE info SET hour15 = $value WHERE id=$id";
        break;
    case 17:
        $sql = "UPDATE info SET hour16 = $value WHERE id=$id";
        break;
    case 18:
        $sql = "UPDATE info SET hour17 = $value WHERE id=$id";
        break;
	case 19:
        $sql = "UPDATE info SET hour18 = $value WHERE id=$id";
        break;
    case 20:
        $sql = "UPDATE info SET hour19 = $value WHERE id=$id";
        break;
	case 21:
        $sql = "UPDATE info SET hour20 = $value WHERE id=$id";
        break;
    case 22:
        $sql = "UPDATE info SET hour21 = $value WHERE id=$id";
        break;
    case 23:
        $sql = "UPDATE info SET hour22 = $value WHERE id=$id";
        break; 
    case 24:
        $sql = "UPDATE info SET hour23 = $value WHERE id=$id";
        break;	
    case 25:
        $sql = "UPDATE info SET park_num = $value WHERE id=$id";
        break;		
}

echo "ok";	

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully <br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>