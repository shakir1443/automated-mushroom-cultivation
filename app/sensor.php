<?php
//open connection to mysql db
$connection = mysqli_connect("localhost","root","123456","mushdb")

or die("Error " . mysqli_error($connection));

//fetch table rows from mysql db
$sql = "select * from sensorinfo where id = 1";

$result = mysqli_query($connection, $sql)
or die("Error in Selecting " . mysqli_error($connection));

//create an array
//$emparray[] = array();
while($row =mysqli_fetch_assoc($result))
{

    $emparray[] = $row;
}

    
//print_r($emparray);
echo json_encode($emparray);

//close the db connection
mysqli_close($connection);
?>
