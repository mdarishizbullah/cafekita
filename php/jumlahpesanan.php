<?php
include "conn.php";

	$query = mysqli_query($conn,"SELECT * FROM nota WHERE not_ver = '1' ");
	$checkCount = $query->num_rows;
	
	echo json_encode($checkCount);
?>