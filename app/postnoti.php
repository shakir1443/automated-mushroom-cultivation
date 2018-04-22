<?php

//open connection to mysql db
$connection = mysqli_connect("localhost","root","123456","mushdb")
or die("Error " . mysqli_error($connection));



$S =$_POST['shown'];


if ($S == "shown")
{

    $sql_query = 'UPDATE timekeeping SET status = 1 WHERE status = 0';
    
}
    


if (mysqli_query($connection, $sql_query)) {
    echo "We just posted a vua news from cool app!";
} else {
    echo "Error: " . $sql_query . "<br>" . mysqli_error($connection);
}

mysqli_close($connection);


?>
