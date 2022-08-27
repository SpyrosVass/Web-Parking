<!DOCTYPE html>

<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == FALSE) {
	header("Location: user.php");
}

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
  height:60px;
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
  font-family: Arial, Helvetica, sans-serif;
  height:60px;
  display: block;
  color: gold;
  font-size:25px;
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

<!-- Διαχειριστής -->

<header>
<img src="parkings logo.png" alt="Image cannot be displayed" width="170" height="170" style="max-width:100%;">
<ul>
<li><form id="formlogout" method="post" action="user.php">
  <input type="submit" value="Έξοδος">
</form></li>
</ul>

</header>

<section>
<div id="onleft" style="margin-top:50px;">
<h2 style="font-size:20px; font-family:verdana;"><pre>    Χάρτης απεικόνισης ρυμοτομίας της πόλης</pre></h2> <br>
<div id="mapid" <!--Here spawn map--> </div><br>
</div>

<div id="onright">
<button type='button' id ="retrive" style="margin:50px; width:350px;">Φόρτωση πολυγώνων από τη βάση</button>
<form id="TimeSimulation" style="border:2px solid black; color: hsl(40, 100%, 50%); background-color:rgb(60, 60, 60); border-radius: 5px; padding:5px;">
  <b>Εισαγωγή Ώρας:</b><br><br>
  <input id="clock" onchange ="gettime();" type="time" name="usr_time" style="width:160px;"><br><br>
  <button id="inc" type='button' style="background-color:black; color:gold; width:70px; font-size:30px;">+</button>
  <button id="dec" type='button' style="background-color:black; color:gold;  width:70px; margin-left:20px; font-size:30px;">-</button><br><br>
  <b>Μεταβολή κατά χρονικό διάστημα:</b> <br><br>
  <input id="radius" type="number" name="radius" min="0" max="60" placeholder="Λεπτά"><br><br>
  <input  style="cursor:pointer;" type="submit" value="Διαθεσιμότητα θέσεων στάθμευσης">
</form>

  <div style="height:193px; margin:70px;">
    <img src="Υπόμνημα.png" alt="Image cannot be displayed" style="width:300px; height:auto;">
    <div style=" border:2px solid black; width:295px; color:black; font-size:18px; text-align:center; background-color:hsl(46, 100%, 50%);"><b>Υπόμνημα</b><br></div>
  </div>
  <div>
	<form id="the-form" style="border:2px solid black; color: hsl(40, 100%, 50%); margin:50px; background-color:rgb(60, 60, 60) ; border-radius: 5px; padding:5px;" enctype="multipart/form-data" >
      <b>Επιλογή KML αρχείου με απεικόνιση ρυμοτομίας πόλης:</b><br><br>
      <input type="file" name="afile" id="afile"><br><br>
	  <p id="uploadstatus" style="color: hsl(40, 100%, 50%);"></p>
      <input type="submit" name="submit" value="Φόρτωση Δεδομένων">
      </form>
      <button type='button' onclick="return confirmDelete();" style="background-color: rgb(204, 0, 0); color:gold; width:370px; border:2px solid black; margin-left:50px;">Διαγραφή Δεδομένων</button>
	
  </div>
</div>
</section>

<footer>
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
var radius =document.getElementById("radius")


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


var inc2 = document.getElementById('inc');
inc2.onclick = function(){
//radius parseint
console.log(1);

clockelem.stepUp(radius.value);
gettime();



}
var dec2 = document.getElementById('dec');
dec2.onclick = function(){
console.log(2);
clockelem.stepDown(radius.value);

gettime();

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
//ajax upload
var form = document.getElementById('the-form');
form.onsubmit = function() {

var upload_status = document.getElementById("uploadstatus");
upload_status.innerHTML = "uploading...";
var fileInput = document.getElementById('afile');
var file = fileInput.files[0];

 
var formData = new FormData();
formData.append('afile', file);

  var xhr = new XMLHttpRequest();
  
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     upload_status.innerHTML = "upload complete";
	 var myObj = JSON.parse(this.responseText);
    for ( var x = 0; x < polygons_array.length; x++) {
  polygons_array[x].remove();
			}
	json_to_map(myObj);
	starting_point();
	
	
    }}
  
  xhr.open('POST', "upload2.php", true);
  xhr.upload.onprogress = function(e) {
    if (e.lengthComputable) {
      var percentComplete = (e.loaded / e.total) * 100;
      console.log(percentComplete + '% uploaded');
    }
  };
 
  xhr.send(formData);

  return false;
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
bindpopup();
}

//Delete data
function confirmDelete() {
    if (confirm("Delete Record?") == true) {
        alert("Now deleting");
		Delete();
        return true;
    } else {
        alert("Cancelled by user");
        return false;
    }
}



function Delete() {
  var xhr = new XMLHttpRequest(); 
  
  xhr.open('GET', "deleteData.php", true);    
  xhr.send();
  return false;
}

//simulation

var formSimulation = document.getElementById('TimeSimulation');
formSimulation.onsubmit = function() {
var times = simtime;
  //var times = y.innerHTML;
  //document.getElementById("45").innerHTML = times;
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

//popups
var popupContent = '<form>\
<input id="popupval" type="text">\
<select name="users" id="popupfield" >\
  <option value="">Select field to update:</option>\
  <option value="1">00:00</option>\
  <option value="2">01:00</option>\
  <option value="3">02:00</option>\
  <option value="4">03:00</option>\
  <option value="5">04:00</option>\
  <option value="6">05:00</option>\
  <option value="7">06:00</option>\
  <option value="8">07:00</option>\
  <option value="9">08:00</option>\
  <option value="10">09:00</option>\
  <option value="11">10:00</option>\
  <option value="12">11:00</option>\
  <option value="13">12:00</option>\
  <option value="14">13:00</option>\
  <option value="15">14:00</option>\
  <option value="16">15:00</option>\
  <option value="17">16:00</option>\
  <option value="18">17:00</option>\
  <option value="19">18:00</option>\
  <option value="20">19:00</option>\
  <option value="21">20:00</option>\
  <option value="22">21:00</option>\
  <option value="23">22:00</option>\
  <option value="24">23:00</option>\
  <option value="25">parking slots</option>\
  </select>\
<input type="submit" id="popupsubmit" value="Submit">\
</form>';









	function bindpopup() {	  
		  for ( var x = 0; x < polygons_array.length; x++) {
		  //console.log(x);
  polygons_array[x].bindPopup(popupContent,{
            keepInView: true,
            closeButton: false
            }).on('click', onMapPolyClick);
			}
	}

	function onMapPolyClick(e){

	for ( var x = 0; x < polygons_array.length; x++) {
	var popup = polygons_array[x].getPopup();
	if (popup.isOpen()===true){
	popupid = x;
	console.log(popupid);
	}	
  }
  var POPvalue = L.DomUtil.get('popupval');
   L.DomEvent.addListener(POPvalue, 'change', function (e) {
    inputvalue = e.target.value;
	});
	
	var POPfield = L.DomUtil.get('popupfield');
   L.DomEvent.addListener(POPfield, 'change', function (e) {
    inputfield = e.target.value;
	});
	
	var buttonSubmit = L.DomUtil.get('popupsubmit');
  L.DomEvent.addListener(buttonSubmit, 'click', function (e) {
    e.preventDefault();
	polygons_array[popupid].closePopup();
inputfield=parseInt(inputfield, 10);
inputvalue=parseFloat(inputvalue);	

	console.log(inputvalue);
	console.log(inputfield);
	popupsend();
	
  });
  }
  
  


function popupsend(){
popupid=popupid + 1;
var params = "x=" + popupid + "&y=" + inputvalue + "&z=" + inputfield;
var xhr = new XMLHttpRequest(); 
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     
	 alert(this.responseText);
    

    }}
  xhr.open('GET', "infoupdate.php?x=" + popupid + "&y=" + inputvalue + "&z=" + inputfield , true);    
  xhr.send();
}
	


</script>

<noscript>Sorry, your browser does not support JavaScript!</noscript>

</body>
</html>