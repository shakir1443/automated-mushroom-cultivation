<?php

require("phpMQTT.php");

$server = "182.48.84.180";     // change if necessary
$port = 1883;                     // change if necessary
$username = "";                   // set your username
$password = "";                   // set your password
$client_id = "1443"; // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new phpMQTT($server, $port, $client_id);

if ($mqtt->connect(true, NULL, $username, $password)) {
	$mqtt->publish("mushroom/user_input", "5", 0);
	$mqtt->close();
} else {
    echo "Time out!\n";
}
