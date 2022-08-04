<?php
include "conn.php";

$id_nota = $_POST['id'];
$not_tmakan = $_POST['notMakan'];
$id_pelanggan = $_POST['idPelanggan'];
$not_waktu = $_POST['notWaktu'];
$not_jPembayaran = $_POST['jPembayaran'];
$not_uCash = $_POST['uCash'];
$not_meja = $_POST['meja'];
$not_total = $_POST['totalNota'];

$sql = "INSERT INTO nota (id_nota, not_tmakan, not_meja ,id_pelanggan, not_waktu, not_jPembayaran, not_uCash, not_total, not_ver) VALUES ('$id_nota','$not_tmakan','$not_meja','$id_pelanggan','$not_waktu','$not_jPembayaran','$not_uCash','$not_total','1')";

if ($conn->query($sql) === TRUE) {
 echo "Pesanan diterima";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}



$lengKer = $_POST['lengKer'];

function insert_into_db($data){
			foreach($data as $key => $value){
		$k[] = $key;
		$v[] = "'".$value."'";
	}
	$k=implode(",", $k);
	$v=implode(",", $v);

	include "conn.php";
	$sql="INSERT INTO transaksi($k) VALUES($v)";
	$run_query=mysqli_query($conn,$sql);

		}

	for ($i=0; $i < $lengKer ; $i++) { 
		# code...
		$data=array(
			'id_nota' => $_POST['id'],
			'id_produk' => $_POST['idProduk'.$i],
			'trs_quantity' => $_POST['jumlahProduk'.$i]
			//'admfee' => $_POST['admfee'.$i],
			//'tutfee' => $_POST['tutfee'.$i],
			//'vanfee' => $_POST['vanfee'.$i],
			//'labfee' => $_POST['labfee'.$i],
			//'othfee' => $_POST['othfee'.$i],
			//'student_id' => uniqid()

	);
		insert_into_db($data);
	
	}