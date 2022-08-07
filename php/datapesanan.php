<?php
include "conn.php";

$id_nota = $_POST['id_nota'];

	$query = mysqli_query($conn,"SELECT * FROM transaksi t JOIN nota n ON n.id_nota = t.id_nota JOIN produk p ON p.id_product = t.id_produk WHERE t.id_nota = '$id_nota' ");
	
	$dbdata = array();
	
	while ( $rows = $query->fetch_assoc())  {
	$dbdata[]=$rows;
  }
  echo json_encode($dbdata);
?>