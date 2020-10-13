<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "cities";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM polygon";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<div id='dom-target' style='display: none'>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$rows[]=$row;
        //echo "id: " . $row['P_placemark_id']." "."linear_coordinates".$row["P_linear_coords"]. "cent_longtitude". " ".$row["P_longtitude"]." "."cent_lattitude".$row["P_latitude"]." "."Population".$row["P_population"] . "<br>";
    }
	echo json_encode($rows,JSON_HEX_TAG);
	echo "</div>";
} else {
    echo "0 results";
}
$conn->close();

?>
<script>
    var div = document.getElementById("dom-target");
    var myData = div.textContent;
	//console.log(myData);
    var jeyson = JSON.parse(myData);
//arxikopoiiseis because reasons!
    var coords =[];
    var ids = [];
    var population = [];
    var centroid = [];
        for (var i in jeyson){
		ids.push(i);
		var temp_linear = jeyson[i].P_linear_coords.split(/[ ,]+/);
		//console.log(temp_linear);
		var temp=[];
		for(var j=0,l=temp_linear.length-1;j<l;j+=2){
		if (j<3164){
			let x = Number(temp_linear[j]);
			let y = Number(temp_linear[j+1]);
			temp.push([y,x]);
		}
		else{break;}
		}
		coords.push(temp);
		var temp_pop = jeyson[i].P_population;
		population.push(temp_pop);
		var temp_cent = [jeyson[i].P_latitude,jeyson[i].P_longtitude];
		centroid.push(temp_cent);
		//console.log(jeyson[i].P_linear_coords);

	}
	//console.log(coords.length);
	//console.log(coords[0][0]);
	//console.log(jeyson[0].P_linear_coords);
	//console.log(population[0]);
	//console.log(centroid[0]);



</script>
