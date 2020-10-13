<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>

<head>


   <title>Σύστημα διαχείρισης της στάθμευσης στους δρόμους μέσω αισθητήρων</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <link rel="stylesheet" type="text/css" href="xampp\htdocs\web_city\CSS\style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel='shortcut icon' type='image/x-icon' href='xampp\htdocs\web_city\IMG\img.png' >
    <script src="https://cdn-webgl.wrld3d.com/wrldjs/dist/latest/wrld.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.1/leaflet.css" rel="stylesheet" />

</head>

<body >
<?php include 'xampp\htdocs\web_city\PHP\Db_sql.php'?>
<?php include 'xampp\htdocs\web_city\PHP\kat.php'?>
<p id="demo" style='display: none'></p>
<div id="container">
       <div id="header">
          <h1 align=center>Σύστημα διαχείρισης της στάθμευσης στους δρόμους  μέσω αισθητήρων</h1>
       </div>

<div class="topnav" id="myTopnav">
  <a href="xampp\htdocs\web_city\HTML\index.html" class="active">Home</a>
  <a href="xampp\htdocs\web_city\HTML\contact.html">Contact</a>
  <a href="xampp\htdocs\web_city\HTML\about.html">About</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<div style="padding-left:16px">
</div>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
function parking_slot(pop) {
var slot;
if(pop==0){
  let min=20;
  let max=50;
  var random = Math.random() * (+max - +min) + +min;
  slot=random;
}
else{
  var min=0;
  var max=100;
    var random = Math.random() * (+max - +min) + +min;
  slot = random;
}
return slot;}

</script>

<div style="position: relative">
    <div id="map" style="height: 600px"></div>
    <script>

      var map = L.Wrld.map("map", "2cbfcaaaa4faed0dc06edf6ffd59b966", {
        center: [40.64215,22.927831],
        zoom: 14
      });
 var circle = L.circle([40.64215,22.927831], {
          color: "yellow",
          //fillColor: "#f03",
          fillOpacity: 0.5,
          radius: 1000}).addTo(map);
	  // var div1 = document.getElementById("dom-target-2");
    //var myData2 = div1.textContent;
		//var rad1234 = document.getElementById("demo");
		//var rad=rad1234.textContent;
		//console.log(rad);

    //calculating for each polygon its class of parking
    //the equation will be :
    var current_hour = new Date().getHours();
    console.log(current_hour);
    console.log(residence[current_hour]);
    var polyclass1=[];
    var polyclass2=[];
    var polyclass3=[];
    var perc = [];    
	for(var pop in population){
      //console.log(pop);
      let total_slots=parking_slot(population[pop]);
      //console.log(population[pop],total_slots);
      let permenent_covered_slots = 0.4*population[pop];
      let real_slots=(total_slots-permenent_covered_slots)*residence[current_hour];
      let percentage = (real_slots/total_slots)*100;
      //console.log(population[pop],percentage);
      //console.log(residence[current_hour]+"*"+"("+total_slots+"-"+permenent_covered_slots+")"+"/"+total_slots+"="+percentage);
	perc.push(percentage);
      if(percentage<20){
        polyclass1.push(pop);
      }
      else if (percentage>=20 && percentage<=60) {
        polyclass2.push(pop);
        }
        else {
          polyclass3.push(pop);

        }
    }
    console.log(polyclass1);
    console.log(polyclass2);
    console.log(polyclass3.length);
     
	for(var j=0,l=coords.length;j<l;j++){
	//console.log(coords[0]);
	if(polyclass2.includes(j.toString())){
	//console.log("here");
	var poly = L.polygon(coords[j],{color:'green'}).addTo(map).bindPopup("Placemark id: "+j+"\nPopulation: "+population[j]+"\npercentage: "+perc[j]);
	}
	if(polyclass1.includes(j.toString())){
	//console.log("here");
	var poly = L.polygon(coords[j],{color:'red'}).addTo(map).bindPopup("Placemark id: "+j+"\nPopulation: "+population[j]+"\npercentage: "+perc[j]);}
	if(polyclass3.includes(j.toString())){
	//console.log("here");
	var poly = L.polygon(coords[j],{color:'blue'}).addTo(map).bindPopup("Placemark id: "+j+"\nPopulation: "+population[j]+"\npercentage: "+perc[j]);}

}
    </script>
  </div>
<div  style="display:inline-block, position:relative">
      <input id="x" name="xcoords" size="30" type="text" value="X coordinate">
	<input id="y" name="ycoords" size="30" type="text" value="Y coordinate">
      <input id="rad" name="radius" size="30" type="text" value="radius">
	<button type="submit" onclick="get_coords_from_user(document.getElementById('x'),document.getElementById('y'),document.getElementById('rad'))" value="Submit">submit</button>
</div>
<script>
function get_coords_from_user(x,y,rad){//alert(x.value);
map.removeLayer(circle);
  var new_circle =L.circle([x.value,y.value], {
          color: "blue",
          //fillColor: "#f03",
          fillOpacity: 0.5,
          radius: rad.value});
    map.addLayer(new_circle);

//circle.setRadius(rad.value);
//console.log(x.value,y.value);
//circle.setLatLng(L.latLng(x.value,y.value));
//circle.setStyle({
//    color: 'yellow'
//});

}
</script>
	<footer id="main-footer">
		<p>Copyright &copy; 2019 </p>
	    </footer>
</body>
</html>
