<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "cafekita";

// Create connection
$koneksi = mysqli_connect($servername, $username, $password, $db);

$idLunas = $_POST['idLunas'];

$sql = "UPDATE nota SET not_ver='2' WHERE id_nota=$idLunas";

if ($koneksi->query($sql) === TRUE) {
 echo  "lunas";
} else {
  echo "Error: " . $sql . "<br>" . $koneksi->error;
}
