<?php
// Server Prod
$dbhost = 'localhost';
$dbusername = 'inxmiles_tpb';
$dbpassword = 'Flatrone2241TPB';
$dbname = 'inxmiles_tpb';
$dbcon = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die(mysqli_connect_errno());

$searchTerm = $_GET['term'];

$query = $dbcon->query("SELECT NOMOR_AJU FROM plb_header ORDER BY ID ASC");
$resultPLB = mysqli_fetch_array($query);

foreach ($resultPLB as $row) {
    $row['NOMOR_AJU'];
}
echo json_encode($list);
