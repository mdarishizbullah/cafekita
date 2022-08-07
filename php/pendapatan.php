<?php
include "conn.php";

	$query = mysqli_query($conn,"SELECT * FROM nota WHERE not_ver = '2' ");
	$checkCount = $query->num_rows;
	
	echo $checkCount;
?>