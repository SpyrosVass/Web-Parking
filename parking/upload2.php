<?php

$target_file = basename($_FILES["afile"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//print_r($_FILES);
// Allow certain file formats
if($FileType != "kml"  ) {
    echo "Sorry, only KML files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if ($xml=simplexml_load_file($_FILES["afile"]["tmp_name"])) {
        //echo "The file ". basename( $_FILES["afile"]["name"]). " has been uploaded.<br>";
		//print_r($xml);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
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

// Delete previous records
$sql = "DELETE FROM starting_point";

if ($conn->query($sql) === TRUE) {
   // echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
$sql = "DELETE FROM polygons";

if ($conn->query($sql) === TRUE) {
    //echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}


//Reset auto
$sql = "ALTER TABLE polygons AUTO_INCREMENT = 1";

if ($conn->query($sql) === TRUE) {
    //echo "AUTO_INCREMENT reseted";
} else {
    echo "AUTO_INCREMENT reset failed: " . $conn->error;
}



// Inserting starting_point

$longitude_sp =$xml->Document->LookAt[0]->longitude;
$latitude_sp =$xml->Document->LookAt[0]->latitude;
$range_sp =$xml->Document->LookAt[0]->range;
$sql = "INSERT INTO starting_point (longitude, latitude, starting_range)
VALUES ($longitude_sp, $latitude_sp, $range_sp)";

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully <br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Inserting polygons

$count = 0;
for ($x = 0; $x <= $count; $x++) {
    $name_pol = $xml->Document->Folder->Placemark[$x]->name;
	//echo $name_pol ."<br>";
	
	
	if (isset($xml->Document->Folder->Placemark[$x]->MultiGeometry->Polygon[0]->outerBoundaryIs->LinearRing->coordinates) === FALSE) {
		$coordinates_pola = $xml->Document->Folder->Placemark[$x]->MultiGeometry->MultiGeometry->Polygon[0]->outerBoundaryIs->LinearRing->coordinates;
		$coordinates_polb = $xml->Document->Folder->Placemark[$x]->MultiGeometry->MultiGeometry->Polygon[1]->outerBoundaryIs->LinearRing->coordinates;
	}else{
		$coordinates_pol = $xml->Document->Folder->Placemark[$x]->MultiGeometry->Polygon[0]->outerBoundaryIs->LinearRing->coordinates;
	}
	//echo $coordinates_pol."<br>";	
	
	$longitude_pol = $xml->Document->Folder->Placemark[$x]->LookAt->longitude;
	//echo $longitude_pol."<br>";
	
    $latitude_pol = $xml->Document->Folder->Placemark[$x]->LookAt->latitude;
	//echo $latitude_pol."<br>";
	
	$starting_range_pol = $xml->Document->Folder->Placemark[$x]->LookAt->range;
	//echo $starting_range_pol."<br>";
	
	

	$string = $xml->Document->Folder->Placemark[$x]->description;
    $string = filter_var($string, FILTER_SANITIZE_NUMBER_INT);
    $display = explode('--', $string);
		
	if (isset($display[3]) === TRUE) {
		$population_pol = $display[3];	
	}else {
		$population_pol = 0;
	}
	//echo $population_pol."<br>";

//With One Polygon	
if (isset($coordinates_pol) === TRUE) {	
	
	$coordinates_pol = str_replace(',', ' ' ,$coordinates_pol);
	
	$temp_str = array_chunk(explode(" ",$coordinates_pol),2);
    foreach( $temp_str as &$val){
        $val  = implode(" ",$val);
    }
    $coordinates_pol = implode(",",$temp_str);
	
	
	$sql = "INSERT INTO polygons(id,
    name,
    coordinates,
    longitude,
    latitude,
    starting_range,
    centroid,
    population)
    VALUES (DEFAULT,
    '$name_pol',
    PolygonFromText('POLYGON(($coordinates_pol))'),$longitude_pol,$latitude_pol,$starting_range_pol,ST_Centroid(PolygonFromText('POLYGON(($coordinates_pol))')),$population_pol)";

 if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully <br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error. "<br>";
}

}//With Two Polygons
else{
	$population_help = $population_pol % 2;
	if ($population_help == 0) {
		$population_pola = $population_pol / 2;
		$population_polb = $population_pol / 2;
	}else {
		$population_pola = $population_pol / 2;
		$population_polb = ($population_pol / 2) - 1;
	}
	
	//First Poly a
	$coordinates_pola = str_replace(',', ' ' ,$coordinates_pola);
	
	$temp_str = array_chunk(explode(" ",$coordinates_pola),2);
    foreach( $temp_str as &$val){
        $val  = implode(" ",$val);
    }
    $coordinates_pola = implode(",",$temp_str);
	
	
	
	$sql = "INSERT INTO polygons(id,
    name,
    coordinates,
    longitude,
    latitude,
    starting_range,
    centroid,
    population)
    VALUES (DEFAULT,
    '$name_pol',
    PolygonFromText('POLYGON(($coordinates_pola))'),$longitude_pol,$latitude_pol,$starting_range_pol,ST_Centroid(PolygonFromText('POLYGON(($coordinates_pola))')),$population_pola)";

 if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully <br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error. "<br>";
}
	//Second Poly b
	$coordinates_polb = str_replace(',', ' ' ,$coordinates_polb);
	
	$temp_str = array_chunk(explode(" ",$coordinates_polb),2);
    foreach( $temp_str as &$val){
        $val  = implode(" ",$val);
    }
    $coordinates_polb = implode(",",$temp_str);
	
	
	$sql = "INSERT INTO polygons(id,
    name,
    coordinates,
    longitude,
    latitude,
    starting_range,
    centroid,
    population)
    VALUES (DEFAULT,
    '$name_pol',
    PolygonFromText('POLYGON(($coordinates_polb))'),$longitude_pol,$latitude_pol,$starting_range_pol,ST_Centroid(PolygonFromText('POLYGON(($coordinates_polb))')),$population_polb)";

 if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully <br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error. "<br>";
}
}



//things for loop
  $help = $x + 1;
  //echo $help."<br>";
  $help = $xml->Document->Folder->Placemark[$help];
  //echo $help."<br>";
  if (isset($help)=== TRUE) {
	  $count = $count +1;
	  //echo "ola kala.<br><br>";
  }

}


//to json
$array = array();
$poly_coor =  mysqli_query( $conn , "SELECT id,name,
    ST_AsGeoJSON(coordinates) AS geometry,
    longitude,latitude,starting_range,
    ST_AsGeoJSON(centroid) AS centroid,
    population FROM polygons");
	
//$result = mysqli_fetch_array($poly_coor);
//echo $result['population'];


while($row = mysqli_fetch_assoc($poly_coor)){

 
  $array[] = $row;


  //echo $row['ST_AsGeoJSON(coordinates)']."<br><br><br>"; 
  //echo $row['name']."<br><br><br>";
}

//print_r($array);

$myJSON = json_encode($array);

echo $myJSON;




//drop info
$sql = "DROP TABLE info ";

if ($conn->query($sql) === TRUE) {
    //echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}



//Creating extra info
$sql = "CREATE TABLE info AS
SELECT id
FROM polygons";

 if ($conn->query($sql) === TRUE) {
    //echo "New table created successfully <br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error. "<br>";
}

//Adding columns
$sql = "ALTER TABLE info
ADD COLUMN hour0 FLOAT, ADD COLUMN hour1 FLOAT, ADD COLUMN hour2 FLOAT, ADD COLUMN hour3 FLOAT,
ADD COLUMN hour4 FLOAT, ADD COLUMN hour5 FLOAT, ADD COLUMN hour6 FLOAT, ADD COLUMN hour7 FLOAT,
ADD COLUMN hour8 FLOAT, ADD COLUMN hour9 FLOAT, ADD COLUMN hour10 FLOAT, ADD COLUMN hour11 FLOAT,
ADD COLUMN hour12 FLOAT, ADD COLUMN hour13 FLOAT, ADD COLUMN hour14 FLOAT, ADD COLUMN hour15 FLOAT,
ADD COLUMN hour16 FLOAT, ADD COLUMN hour17 FLOAT, ADD COLUMN hour18 FLOAT, ADD COLUMN hour19 FLOAT,
ADD COLUMN hour20 FLOAT, ADD COLUMN hour21 FLOAT, ADD COLUMN hour22 FLOAT, ADD COLUMN hour23 FLOAT,
ADD COLUMN park_num INT";

if ($conn->query($sql) === TRUE) {
    //echo "Table changed <br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error. "<br>";
}

//Update table with random
$min_int = 0;
$max_int = 200;
$min_float = 0;
$max_float = 10;

$sql = "SELECT id FROM info";

if ($result=mysqli_query($conn,$sql))
  {
  $rowcount=mysqli_num_rows($result);

  mysqli_free_result($result);
  }


for ($i = 1; $i <= $rowcount; $i++) {
$random0 = rand($min_float,$max_float)/10;
$random1 = rand($min_float,$max_float)/10;
$random2 = rand($min_float,$max_float)/10;
$random3 = rand($min_float,$max_float)/10;
$random4 = rand($min_float,$max_float)/10;
$random5 = rand($min_float,$max_float)/10;
$random6 = rand($min_float,$max_float)/10;
$random7 = rand($min_float,$max_float)/10;
$random8 = rand($min_float,$max_float)/10;
$random9 = rand($min_float,$max_float)/10;
$random10 = rand($min_float,$max_float)/10;
$random11 = rand($min_float,$max_float)/10;
$random12 = rand($min_float,$max_float)/10;
$random13 = rand($min_float,$max_float)/10;
$random14 = rand($min_float,$max_float)/10;
$random15 = rand($min_float,$max_float)/10;
$random16 = rand($min_float,$max_float)/10;
$random17 = rand($min_float,$max_float)/10;
$random18 = rand($min_float,$max_float)/10;
$random19 = rand($min_float,$max_float)/10;
$random20 = rand($min_float,$max_float)/10;
$random21 = rand($min_float,$max_float)/10;
$random22 = rand($min_float,$max_float)/10;
$random23 = rand($min_float,$max_float)/10;

$random = rand($min_int,$max_int);

$sql = "UPDATE info
SET hour0 = $random0, hour1 = $random1, hour2 = $random2, hour3 = $random3, hour4 = $random4, hour5 = $random5, hour6 = $random6, hour7 = $random7,
hour8 = $random8, hour9 = $random9, hour10 = $random10, hour11 = $random11, hour12 = $random12, hour13 = $random13, hour14 = $random14, hour15 = $random15,
hour16 = $random16, hour17 = $random17, hour18 = $random18, hour19 = $random19, hour20 = $random20, hour21 = $random21, hour22 = $random22, hour23 = $random23, park_num = $random  WHERE id = $i";

if ($conn->query($sql) === TRUE) {
    //echo "Table changed <br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error. "<br>";
}
}

//Closing connection
$conn->close();


?>