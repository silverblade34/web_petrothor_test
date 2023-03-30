<?php
$servername = "67.205.184.183";
$username = "root";
$password = 'Sys4Log$$sa';//Sys4Log$$sa
$dbname = "dbtestpetrothor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");
?>