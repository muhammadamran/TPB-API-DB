<?php
// Server Prod
include "../../include/connection.php";
$searchTerm = $_GET['term'];
$sql = $dbcon->query("SELECT NOMOR_AJU FROM plb_header  WHERE NOMOR_AJU LIKE '%" . $searchTerm . "%'  ORDER BY ID ASC");
while ($row = mysqli_fetch_array($sql)) {
    $data[] = $row['NOMOR_AJU'];
}

$check = json_encode($data);

if ($check == null || $check == 'null') {
    $data = 'Tidak ada Nomor Pengajuan PLB';
} else {
    echo json_encode($data);
}
