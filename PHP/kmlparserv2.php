<?php
include 'phpconnect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo 'Begin Script <br/><hr/>';
$polygonDataArray = array();
$kml = simplexml_load_file('/opt/lampp/htdocs/geonode-population_data_per_block.kml');
//print_r($kml->Document); // debug the whole document data
/* You MUST update this selector to math your KML document tree
 pm.MultiGeometry.Polygon.outerBoundaryIs.LinearRing.coordinates*/
$pop = array();
$coords = array();
$count=0;
foreach($kml->Document->Folder->Placemark as $pm){
 //print_r($pm);
	$htmltoparse = $pm->description;
	$dom = new DOMDocument;
	$dom->loadHTML($htmltoparse);
	$li = $dom->getElementsByTagName('li');
	//print_r($li);
	for ($i = 0; $i < $li->length; $i++){
		$attr = $li->item($i)->textContent;
		//echo $li->length;
		//print_r($attr);
		//echo "here";
		if($li->length==3){
			$attr = $li->item($i)->textContent;
			$temp = explode(":",$attr);
			//print_r($temp);
			$count++;
			array_push($pop,$temp[1]);
			break;
			//print_r($temp[1]);
		}
		else {
				array_push($pop,0);
				break;
		}
	//print_r(item);
	}
	//print_r($htmltoparse);
 	if(isset($pm->MultiGeometry->Polygon)){
		// Process polygon datas
		// Get coordinates for 'outerBoundaryIs', other possible data not considered is 'innerBoundaryIs'
		$coordinates = $pm->MultiGeometry->Polygon->outerBoundaryIs->LinearRing->coordinates;
		$cordsData = trim(((string) $coordinates));

				 //print_r($cordsData);
                // check if coordinate data is available
                if(isset($cordsData) && !empty($cordsData)){
                    $explodedData = explode("\n", $cordsData);//xwrizei ena string se mikrotera pou vriskei \n
                    $explodedData = array_map('trim', $explodedData);//efarmozei ti tin trim (pou xwrizei tis lekseis enos string) gia ka8e megalo string pou pirame apo panw
				//print_r("hello");
                    		//print_r($explodedData);
                    // next for each of the points build the polygon data
                    $points = "";
                    foreach ($explodedData as $index => $coordinateString) {
                        $coordinateSet = array_map('trim', explode(',', $coordinateString));
			//$test = array_map('trim', explode(' ', $coordinateSet));
			array_push($coords,$coordinateSet);
			//print_r($coordinateSet);

                }
	} else {
		echo '<br/>Not a polygon - skipping';
	}
}
}
for ($i = 0; $i< 3164; $i++){
	$test1 = implode(',',$coords[$i]);
	$test2 = (int)$pop[$i];
	//print_r($test1);
	//print_r($test2);
$sql = "INSERT INTO polygon(P_linear_coords,P_population) VALUES('$test1','$test2');";

	if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
	} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

	$conn->close();


print_r(count($pop));
//echo "<br>";
//print_r(count($coords));
//echo "<br>";
//print_r($count);

?>
