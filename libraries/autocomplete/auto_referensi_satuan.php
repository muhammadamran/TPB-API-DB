<?php
include "../../include/connection.php";
$searchTerm = $_GET['term'];

$sql = $dbcon->query("SELECT * FROM referensi_satuan WHERE KODE_SATUAN LIKE '%".$searchTerm."%' ORDER BY ID ASC");
while ($row = mysqli_fetch_array($sql)) {
    $data[] = $row['KODE_SATUAN'];
}
echo json_encode($data);
?>