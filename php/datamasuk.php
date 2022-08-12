<?php
include "conn.php";

$stmt = $conne->prepare("SELECT * FROM nota WHERE not_ver = '1'");
$stmt->execute();

$nota = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($nota);