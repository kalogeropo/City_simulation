<?php 


$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"cities");


$trn= mysqli_query($con,"TRUNCATE TABLE .polygon ");

if($trn  !== FALSE)
{
   echo("All rows have been deleted.");
}
else
{
   echo("No rows have been deleted.");
}

?>

