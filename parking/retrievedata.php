<?php




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



//to json
$array = array();
$poly_coor =  mysqli_query( $conn , "SELECT id,name,
    ST_AsGeoJSON(coordinates) AS geometry,
    longitude,latitude,starting_range,
    ST_AsGeoJSON(centroid) AS centroid,
    population FROM polygons");
	


while($row = mysqli_fetch_assoc($poly_coor)){

 
  $array[] = $row;


}


$myJSON = json_encode($array);

echo $myJSON;



//Closing connection
$conn->close();


?>