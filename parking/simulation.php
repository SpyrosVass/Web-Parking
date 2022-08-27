<?php



$time = $_POST["x"];

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




$reserv_color = array();
$sql = "SELECT id FROM info";

if ($result=mysqli_query($conn,$sql))
  {
  $rowcount=mysqli_num_rows($result);

  mysqli_free_result($result);
  }


switch ($time) {
	case 0:
	    for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour0 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour0'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}	
        break;
    case 1:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour1 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour1'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 2:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour2 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour2'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 3:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour3 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour3'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
	case 4:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour4 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour4'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 5:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour5 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour5'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 6:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour6 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour6'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
	case 7:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour7 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour7'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 8:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour8 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour8'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 9:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour9 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour9'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
	case 10:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour10 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour10'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 11:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour11 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour11'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 12:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour12 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour12'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
	case 13:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour13 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour13'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 14:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour14 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour14'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 15:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour15 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour15'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
	case 16:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour16 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour16'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 17:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour17 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour17'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 18:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour18 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour18'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
	case 19:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour19 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour19'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 20:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour20 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour20'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
	case 21:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour21 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour21'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 22:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour22 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour22'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;
    case 23:
        for ($i = 0; $i < $rowcount; $i++){
		//for the hour of the day
		$sql = "SELECT hour23 FROM info WHERE id=($i+1)";
		$sql =  mysqli_query( $conn , $sql);
		$row = mysqli_fetch_assoc($sql);
		
		//for the polulation
		$sql2 = "SELECT population FROM polygons WHERE id=($i+1)";
		$sql2 =  mysqli_query( $conn , $sql2);
		$row2 = mysqli_fetch_assoc($sql2);
		
		//for the parking num
		$sql3 = "SELECT park_num FROM info WHERE id=($i+1)";
		$sql3 =  mysqli_query( $conn , $sql3);
		$row3 = mysqli_fetch_assoc($sql3);

        $hour = $row['hour23'];
		$population = $row2['population'];
        $park_num = $row3['park_num'];
		
		//simulation
		$color = simulation($hour,$population,$park_num);
		$reserv_color[$i] = $color;
	}
        break;       
}


	$myJSON = json_encode($reserv_color);
    echo $myJSON;

	 
    function simulation($hour,$population,$park_num) {
		$hour = 1 - $hour;
        $fixed = $population * (20/100);
        $free_park_num = $park_num - $fixed;
		
		if ($free_park_num<=0){
			$reserved_percent = 100;	
		}else{
		    $free_park_num = $free_park_num * $hour;
		    $reserved_park = $park_num - $free_park_num;
		    $reserved_percent = floor(($reserved_park/$park_num) * 100);
			
		}
		
		if($reserved_percent<65){
			$color = "green";
		}else if($reserved_percent<85 && $reserved_percent>=65){
			$color = "yellow";
		}else if($reserved_percent>=85){
			$color = "red";
		}
		return $color;
		
    }
	

$conn->close();


?>