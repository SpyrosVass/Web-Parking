<!DOCTYPE html>

<?php
session_start();


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



$_SESSION['loggedin'] = FALSE;
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) {
	header("Location: admin.php");
}

if(isset($_POST["username"]) && isset($_POST["psw"])) {
	if ($_POST["username"] == $help1 && $_POST["psw"] == $help2) {
		$_SESSION['loggedin'] = TRUE;
		header("Location: admin.php");
	}
}

$conn->close();


?>

<html lang="en">
<head>
	
	<title>ParKings</title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
	integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
	crossorigin=""/>
   
	<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
	integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
	crossorigin="">
	</script>

<style>

button {
  background-color: gold;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  color:gold;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  height:200px;
  width: 200px;
  border-radius: 100%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}


.modal {
  z-index: 5;
  display: none;
  position:absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.4);
  padding-top: 60px;
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto;
  border: 1px solid #888;
  width: 80%;
}

.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}

header {
  background-color: black;
  padding: 30px;
  text-align: center;
  font-size: 35px;
  color: black;
  margin:25px;
}

section{
 display: -webkit-flex;
  display: flex;
}

body {
  background-image: url('background.jpg');
	font-family: Arial, Helvetica, sans-serif;
	margin:0;
	color:hsl(40, 100%, 50%) ;
	}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: rgb(60, 60, 60);
}

li {
  float: right;
}

li a {
  display: block;
  color: gold;
  font-size:15px;
  text-align: center;
  padding: 15px;
  text-decoration: none;
}

li a:hover {
	color: black;
  background-color:hsl(50, 100%, 50%);
}

input[type=submit] {
  width: 100%;
  background-color: black;
  color: yellow;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: hsl(40, 100%, 50%);
  color: black;
}

#onleft{
-webkit-flex: 1;
  -ms-flex: 1;
  flex: 1;
}

#onright {
-webkit-flex: 2;
  -ms-flex: 2;
  flex: 2;
  padding:10px;
}

footer {
  background-color: black;
  padding: 10px;
  color: gold;
  margin:25px;
}

#mapid {
z-index:1;
	position:relative;
	width: 800px;
	height:800px;
	margin:15px;
	}

</style>
</head>
<body>

<div id="login" class="modal">
  
  <form class="modal-content animate" method="post" action="user.php" style="background-image: url('login font.jpg');">
    <div class="imgcontainer">
      <span onclick="document.getElementById('login').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="parkings logo.png" alt="Image cannot be displayed" class="avatar" style=" margin-right: 600px;">
    </div>

    <div class="container" style="margin-left:300px;">
      <label for="uname" style="color: gold; font-family:verdana; font-size:20px;"><b>Όνομα Χρήστη</b></label><br><br>
      <input id="username" name="username" type="text" placeholder="Εισάγετε Όνομα" required>
		<br><br>
      <label for="psw" style="color: gold; font-family:verdana; font-size:20px;"><b>Κωδικός Πρόσβασης</b></label><br><br>
      <input id="psw" name="psw" type="password" placeholder="Εισάγετε Κωδικό" required><br><br>
	  <input type="checkbox" onclick="myFunction()">Εμφάνιση Κωδικού
        <br><br>
      <button type="submit" style="color: gold; background-color:black; font-family:verdana; font-size:20px;">Είσοδος</button>
    </div>
	<div style="margin-left:375px;">
    <p id="capslck">WARNING! Caps lock is ON.</p>
	</div>
    <div class="container">
      <button type="button" style="background-color: black; color=gold;" onclick="document.getElementById('login').style.display='none'" class="cancelbtn">Άκυρο</button>
    </div>
  </form>
</div>

<div id="failure" style="text-align:center">
<!--Εσφαλμένο Όνομα Χρήστη ή Κωδικός-->
</div>

<!-- Χρήστης -->

<header class="header">
<img src="parkings logo.png" alt="Image cannot be displayed" width="170" height="170" style="max-width:100%;">
<ul>
  <li><button onclick="document.getElementById('login').style.display='block'" style="width:auto;">Είσοδος ως Διαχειριστής</button></li>
</ul>
</header>

<section class="sec">
<div id="onleft" style="margin-top:50px;">
<h2 style="font-size:20px; font-family:verdana;"><pre>    Χάρτης απεικόνισης ρυμοτομίας της πόλης</pre></h2> <br>
<div id="mapid" <!--Here spawn map--> </div><br>
</div>

<div id="onright">
<button type='button' id ="retrive" style="margin:50px; width:350px;">Φόρτωση πολυγώνων από τη βάση</button>
<form id="TimeSimulation" style="border:2px solid black; color: hsl(40, 100%, 50%); background-color:rgb(60, 60, 60) ; border-radius: 5px; padding:5px;">
  <b>Εισαγωγή Ώρας:</b><br><br>
  <input id="clock" type="time" name="usr_time"><br><br>
  <input style="cursor:pointer;" type="submit" value="Διαθεσιμότητα θέσεων στάθμευσης">
</form>


  <div style="height:193px; margin:70px;">
    <img src="Υπόμνημα.png" alt="Image cannot be displayed" style="width:300px; height:auto;">
    <div style=" border:2px solid black; width:295px; color:black; font-size:18px; text-align:center; background-color:hsl(46, 100%, 50%);"><b>Υπόμνημα</b><br></div>
  </div>
  <div>
	<form  style="border:2px solid black; color: hsl(40, 100%, 50%); margin:50px; background-color:rgb(60, 60, 60) ; border-radius: 5px; padding:5px;">
      <b>Κάντε click στο σημείο που θέλετε να μεταβείτε και συμπληρώστε τα παρακάτω πεδία:</b><br><br>
      <b>Ώρα Άφιξης:</b> <input type="time" name="usr_time"><br><br>
      <b>Μέγιστη Απόσταση από Επιθυμητή Θέση:</b> <input type="number" name="radius" min="0" placeholder="Μέτρα"><br><br>
      <input style="cursor:pointer;" type="submit" value="Αναζήτηση περιοχών στάθμευσης">
	</form>
  </div>
</div>
</section>

<footer class="footer">
	<div>
		<p>Επικοινωνία<br><br>6980085244<br>6976042597<br>6980240425<hr></p>
	</div>
	<p> &copy; 2019 ParKings Με την επιφύλαξη παντός δικαιώματος </p>
</footer>

<script>
var modal = document.getElementById('login');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<script>
function myFunction() {
  var x = document.getElementById("psw");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<script>
var input = document.getElementById("username");
var text = document.getElementById("capslck");
text.style.display = "none";
input.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
    text.style.display = "block";
  } else {
    text.style.display = "none"
  }
});

var input = document.getElementById("psw");
var text = document.getElementById("capslck");
input.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
});
</script>



<script>



var clockelem = document.getElementById("clock");

//fixing time format
var simtime;
var today= new Date();
var hours=today.getHours();
var min=today.getMinutes();
console.log(hours);
console.log(min);
fixtime(hours,min);
function fixtime(h,m){
var time
if (h>9){
if(m>9){
 time =h + ':' + m ;
 }else{
 time =h + ':' + "0" + m;
 }
}else{
if(m>9){
 time ="0" + h + ':' + m;
 }else{
 time ="0" + h + ':' + "0" + m;
 }
}
console.log(time);
clockelem.value = time;
}


gettime();

function gettime(){
var clocklval = clockelem.value;
simtime = parseInt(clocklval.match(/\d+/),10);
console.log(simtime);

}


//starting point

var mymap = L.map('mapid').setView([38.40,24.40], 6);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			maxZoom: 18,
			id: 'mapbox.streets',
			accessToken: 'pk.eyJ1IjoiYm95MTc4IiwiYSI6ImNrMTI4bzF6eTBtdG4zbm81d21uZG1lZGYifQ.0gIfHWsYzxrKI7jytndiyA'
		}).addTo(mymap);
		
		





//misc

var inputfield;
var inputvalue;	
var popupid;
var polygons_array=[];



//retrive data from database

var RETbutton = document.getElementById('retrive');
RETbutton.onclick = function(){
var xhr = new XMLHttpRequest();
  
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	 var myObj = JSON.parse(this.responseText);
    for ( var x = 0; x < polygons_array.length; x++) {
  polygons_array[x].remove();
			}
	json_to_map(myObj);
	starting_point();
	
	
    }}
  
  xhr.open('GET', "retrievedata.php", true);
  
 
  xhr.send();
}

//retrive starting point


function starting_point() {
  
  var s = document.createElement("script");
  s.src = "getStartingPoint.php";
  document.body.appendChild(s);
}
function myFunc(myObj) {
  var longitude = myObj.longitude ;
  var latitude = myObj.latitude ;
  mymap.setView([latitude,longitude], 12);
}
//drawing polygons

function json_to_map(obj){
polygons_array=[];
var size = Object.keys(obj).length;
console.log(size);
for ( var e = 0; e < size; e++) {

var coordinates = JSON.stringify(obj[e].geometry);

coordinates = coordinates.replace(']}"','');
coordinates = coordinates.substr(43);+
console.log(coordinates);
var ob = JSON.parse("["+coordinates+"]");

var size2 = Object.keys(ob[0]).length;

for ( var i = 0; i < size2; i++) {
console.log(i);
ob[0][i].reverse();
  
}
console.log(ob);

 polygons_array.push(L.polygon(ob, { fillColor: 'gray',color: 'gray'
}).addTo(mymap));
}
console.log(polygons_array);

}






//simulation

var formSimulation = document.getElementById('TimeSimulation');
formSimulation.onsubmit = function() {
var times = simtime;
 
  var xmlHttp  = new XMLHttpRequest(); 
  xmlHttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     
	 myFunc2(this.responseText);
    

    }}
  
  xmlHttp.open("POST", "simulation.php", true);  
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
  xmlHttp.send("x=" + times);
  
  return false;
}
function myFunc2(myObj) {

var Obj = JSON.parse(myObj);

  var x
  var colors_array = [];
  for ( var x = 0; x < Obj.length; x++) {
   colors_array[x]=Obj[x];
  }
 
  for ( var x = 0; x < polygons_array.length; x++) {
  
  polygons_array[x].setStyle({fillColor: colors_array[x], color: colors_array[x]});
  }
}




</script>

<noscript>Sorry, your browser does not support JavaScript!</noscript>

</body>
</html>