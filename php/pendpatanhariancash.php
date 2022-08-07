<?php
include "conn.php";
$not_wnota = $_POST['tanggalDiambil'];

//$query = mysqli_query($conn,"SELECT sum(not_total) FROM nota WHERE not_waktu LIKE '$not_wnota' ");
//$sql = "SELECT sum(not_total) FROM nota WHERE not_waktu LIKE '$not_wnota' ";
$sql = "SELECT not_total FROM nota WHERE not_waktu LIKE '$not_wnota' AND not_jPembayaran = 'cash' AND not_ver = '2'";
	$dataProduct = $conn->query($sql);
	
//$dataPro = $conn->query($sql);
	echo json_encode( $dataProduct);
	// AND not_ver = '2' AND not_jPembayaran = 'cash' 