<?php
//open connection to mysql db
$connection = mysqli_connect("localhost","root","123456","mushdb")

or die("Error " . mysqli_error($connection));

//fetch table rows from mysql db
//$sql = "select * from timekeeping where status = 0 order by id";
$sql = "select * from timekeeping order by id DESC";

$result = mysqli_query($connection, $sql)
or die("Error in Selecting " . mysqli_error($connection));

//create an array
//$emparray[] = array();
while($row =mysqli_fetch_assoc($result))
{

    $emparray[] = $row;
}

    
//print_r($emparray);
echo json_encode($emparray,JSON_UNESCAPED_SLASHES);

//close the db connection
mysqli_close($connection);
?>
