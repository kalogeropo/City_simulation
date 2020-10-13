<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "cities";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM demand";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<div id='target' style='display: none'>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$demandrows[]=$row;
        //echo "id: " . $row['P_placemark_id']." "."linear_coordinates".$row["P_linear_coords"]. "cent_longtitude". " ".$row["P_longtitude"]." "."cent_lattitude".$row["P_latitude"]." "."Population".$row["P_population"] . "<br>";
    }
	echo json_encode($demandrows,JSON_HEX_TAG);
	echo "</div>";
} else {
    echo "0 results";
}
$conn->close();

?>
<script>
    var div1 = document.getElementById("target");
    var myData2 = div1.textContent;
	//console.log(myData2);
    var jeyson2 = JSON.parse(myData2);
	//console.log(jeyson2.length)
//arxikopoiiseis because reasons!
    var time =[];
    var center = [];
    var residence = [];
    var rural = [];
        for (var i in jeyson2){
		time.push(i);
		center.push(Number(jeyson2[i].D_center));
		residence.push(Number(jeyson2[i].D_residence));
		rural.push(Number(jeyson2[i].D_rural));

		//console.log(jeyson[i].P_linear_coords);

	}
	//console.log(center.length)
</script>
