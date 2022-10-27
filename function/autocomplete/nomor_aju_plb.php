<?php
// Server Prod
$dbhost = 'localhost';
$dbusername = 'inxmiles_tpb';
$dbpassword = 'Flatrone2241TPB';
$dbname = 'inxmiles_tpb';
$dbcon = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die(mysqli_connect_errno());

$searchTerm = $_GET['term'];
$sql = $dbcon->query("SELECT NOMOR_AJU FROM plb_header  WHERE NOMOR_AJU LIKE '%" . $searchTerm . "%'  ORDER BY ID ASC");
while ($row = mysqli_fetch_array($sql)) {
    $data[] = $row['NOMOR_AJU'];
}
echo json_encode($data);
