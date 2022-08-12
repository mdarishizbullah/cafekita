<?php
include "conn.php";

$id_nota = $_POST['id_nota'];

$stmt = $conne->prepare("SELECT * FROM transaksi t JOIN produk p ON t.id_produk = p.id_product JOIN nota n ON t.id_nota = n.id_nota WHERE t.id_nota ='$id_nota'");
$stmt->execute();

$nota = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($nota);