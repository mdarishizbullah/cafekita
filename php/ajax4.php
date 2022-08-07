<?php
include "conn.php";

$idLunas = $_POST['idLunas'];

$sql = "UPDATE nota SET not_ver='2' WHERE id_nota=$idLunas";

if ($conn->query($sql) === TRUE) {
 echo  "lunas";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
