<?php $servernamea = "localhost";
$usernamea = "root";
$passworda = "";
$dba = "cafekita";

// Create connection
$conna = new mysqli($servernamea, $usernamea, $passworda, $dba);

// Check connection
if ($conna->connect_error) {
  die("Connection failed: " . $conna->connect_error);
}
	$query = mysqli_query($conna,"SELECT * FROM nota WHERE not_ver = '1' ");
	$checkCount = $query->num_rows;
	
	echo $checkCount;
?>