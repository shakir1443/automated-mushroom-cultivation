<?php

//open connection to mysql db
$connection = mysqli_connect("localhost","root","123456","mushdb")
or die("Error " . mysqli_error($connection));


$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['pass'];


// // recieved from app

 $sql_query = "INSERT INTO login (username,email,pass) VALUES ('$name','$email','$pass')";


if (mysqli_query($connection, $sql_query)) {
    echo "Compelete";
} else {
    echo "Error: " . $sql_query . "<br>" . mysqli_error($connection);
}


mysqli_close($connection);

?>
