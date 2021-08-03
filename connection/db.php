<?php

//main connection
$servername = "156.67.222.169"; //server
$username = "u414334225_hotelAdmin"; //username
$password = "Hotel@1234"; //password
$dbname = "u414334225_hotel";  //database

// Create connection
$db = mysqli_connect($servername, $username, $password, $dbname); // connecting 
// Check connection
if (!$db) {       //checking connection to DB	
    die("Connection failed: " . mysqli_connect_error());
}

?>