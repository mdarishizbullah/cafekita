<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "cafekita";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

$conne= new PDO("mysql:host=$servername;dbname=cafekita", $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}