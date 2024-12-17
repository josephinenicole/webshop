<?php
if ( isset($_GET["id"])) {
  $id = $_GET["id"]; 

$servername = "localhost";
$username = "root";
$password = "";
$database = "secudrive_shop"; 


// Create connection
$connection = new mysqli($servername, $username, $password, $database); 
}
?>